<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalesOrder;
use App\Models\InventoryOutlet;
use App\Models\Products;
use Session;
use App\User;
use App\CartSalesOrder;
use App\Models\AuditTrail;
use App\Models\SalesOrderList;
use App\Wholesaler;
use DB;

class SalesOrdersController extends Controller
{
    var $counter = 000;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $users_id = User::find($user_id);
        $salesOrders = SalesOrder::orderBy('id','desc')->get();
        
        $wholesalerSalesOrders = SalesOrder::where('users_id', '=', $user_id)->get();

        return view('salesorder.index')->with('salesOrders', $salesOrders)->with('users_id',$users_id)->with('wholesalerSalesOrders',$wholesalerSalesOrders);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = auth()->user()->id;
        $users_id = User::find($user_id);

        //Audit Trail
        $auditTrail = AuditTrail::create([
            'action' => 'Created Sales Order',
            'action_by' => $users_id->name,
        ]);
        

        if(!Session::has('cartSalesOrder')) {
            return view('salesorder.create')->with('users_id',$users_id);
        } else {

            $oldSalesOrderCart = Session::get('cartSalesOrder');
            $salesOrderCart = new CartSalesOrder($oldSalesOrderCart);
            $products = $salesOrderCart->items;

            $totalPrice = 0;

            foreach($products as $product) {
                $totalPrice += $product['qty']*$product['unitPrice'];
            }
            

            $salesOrder = new SalesOrder;
            $salesOrder->statuses_id = 1;
            $salesOrder->status = "pending";
            $salesOrder->date =  $salesOrderCart->date;
            $salesOrder->remarks = $salesOrderCart->remarks;
            $salesOrder->audit_trails_id = $auditTrail->id;
            $salesOrder->users_id=$user_id;
            $salesOrder->totalQuantity=$salesOrderCart->totalQty;
            $salesOrder->totalPrice=$totalPrice;
            $salesOrder->save();

            foreach($products as $product) {
                $salesOrderList = new SalesOrderList;
                $salesOrderList->sales_order_id =$salesOrder['id'];
                $salesOrderList->products_id = $product['item']['id'];
                $salesOrderList->quantity=$product['qty'];
                $salesOrderList->subtotal=$product['qty']*$product['unitPrice'];
                $salesOrderList->save();
            }
            Session::forget("cartSalesOrder");
        }

        return redirect('/salesorder')->with('success', 'Sales Order Created');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user_id = auth()->user()->id;
        $users_id = User::find($user_id);

        $salesOrder = SalesOrder::find($id);
        $salesOrderId = SalesOrder::find($id)->id;
        $salesOrderLists = SalesOrderList::where('sales_order_id', '=', $salesOrderId)->get();
        $totalPrice = DB::table('sales_order_list')->where('sales_order_id', $salesOrderId)->sum('subtotal');
        

        return view('salesorder.show')->with('users_id',$users_id)->with('salesOrder',$salesOrder)->with('salesOrderLists',$salesOrderLists)->with('totalPrice',$totalPrice);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user_id = auth()->user()->id;
        $users_id = User::find($user_id); 

        $salesOrders = SalesOrder::find($id);
        $salesOrderId = SalesOrder::find($id)->id;
        $sales = SalesOrderList::where('sales_order_id', $salesOrderId)->get();

        return view('salesorder.edit')->with('sales', $sales)->with('users_id',$users_id)->with('salesOrders',$salesOrders);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $login_user_id = auth()->user()->id;
        $login_user = User::find($login_user_id);

        //Audit Trail
        $auditTrail = AuditTrail::create([
            'action' => 'Updated Sales Order',
            'action_by' => $login_user->name,
        ]);

        $this->validate($request, [
            // 'quantity' => 'required',
            'status' => 'required',
        ]);

        $sales = SalesOrder::find($id);
        // $transfer->quantity = $request->input('quantity');
        $sales->status = $request->input('status');
        $sales->save();

        return redirect('/salesorder')->with('success', 'Request Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getSalesOrderAddToCart(Request $request, $id, $quantity, $unitPrice, $date, $remarks) {
        $user_id = auth()->user()->id;
        $product = Products::find($id);
        $oldSalesOrderCart = Session::has('cartSalesOrder') ? Session::get('cartSalesOrder') : null;

        $salesOrderCart = new CartSalesOrder($oldSalesOrderCart);
        $salesOrderCart->add($product, $product->id, $quantity, $unitPrice, $date, $remarks, $user_id);

        $request->session()->put('cartSalesOrder', $salesOrderCart);
        
        return redirect()->route('/salesorder/create/');
    }

    public function getSalesOrderCart() {
        $user_id = auth()->user()->id;
        $users_id = User::find($user_id);

        if(!Session::has('cartSalesOrder')) {
            return view('salesorder.create')->with('users_id',$users_id);
        } else {
            $oldSalesOrderCart = Session::get('cartSalesOrder');
            $salesOrderCart = new CartSalesOrder($oldSalesOrderCart);

            // dd($oldSalesOrderCart);

            return view('salesorder.create', [
                'products' => $salesOrderCart->items
            ])->with('users_id', $users_id) ;
        }
    }

    public function sortDate($startDate,$endDate){
        $salesOrder = SalesOrder::select('sales_order.id','statuses_id','status','date','sales_order_number','status_name')
                     ->leftJoin('statuses','sales_order.statuses_id','=','statuses.id')
                     ->whereBetween('date',array($startDate,$endDate))
                     ->get()->toArray();

        return response($salesOrder);
    }
    
    public function viewByStatusesId($statuses_id){
        $user_id = auth()->user()->id;
        $users_id = User::find($user_id);

        $salesOrder = SalesOrder::find($id);
        $salesOrderId = SalesOrder::find($id)->id;
        $salesOrderLists = SalesOrderList::where('statuses_id', '=', $statuses_id)->get();
        $totalPrice = DB::table('sales_order_list')->where('sales_order_id', $salesOrderId)->sum('subtotal');
        

        return view('salesorder.show')->with('users_id',$users_id)->with('salesOrder',$salesOrder)->with('salesOrderLists',$salesOrderLists)->with('totalPrice',$totalPrice);
    }
    
    public function getRemoveItem($id) {
        $user_id = auth()->user()->id;
        $users_id = User::find($user_id);
        $oldSalesOrderCart = Session::get('cartSalesOrder');
        $salesOrderCart = new CartSalesOrder($oldSalesOrderCart);
        $salesOrderCart->removeItem($id);
        Session::put('cartSalesOrder', $salesOrderCart);
        if($salesOrderCart->items == null) {
             Session::forget("cartSalesOrder");
        }
        Session::put('cartSalesOrder', $salesOrderCart);
        return view('salesorder.create', [
                'products' => $salesOrderCart->items
            ])->with('users_id',$users_id);
        
    }

    public function exportFile($type){
        $salesorderexcel = DB::table('sales_order')
        ->join('statuses', 'sales_order.statuses_id', '=', 'statuses.id')
        ->join('users', 'sales_order.users_id', '=', 'users.id')
        ->join('wholesalers', 'users.id', '=', 'wholesalers.users_id')
        ->select('sales_order.id', 'sales_order.totalQuantity', 'sales_order.totalPrice', 'statuses.status_name', 'sales_order.remarks', 'sales_order.date', 'users.name', 'wholesalers.shipping_address', 'wholesalers.phone_number')
        ->orderBy('sales_order.id')
        ->get()
        ->toArray();
        $data= json_decode( json_encode($salesorderexcel), true);

        return \Excel::create('salesorder', function($excel) use ($data) {
            $excel->sheet('sheet name', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->download($type);
    }
}
