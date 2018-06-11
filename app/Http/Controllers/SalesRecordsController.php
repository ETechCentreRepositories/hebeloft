<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalesRecord;
use App\Models\InventoryOutlet;
use App\Models\Products;
use Session;
use App\User;
use App\CartSalesRecord;
use App\Models\AuditTrail;
use App\Models\SalesRecordList;

use DB;

class SalesRecordsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user_id = auth()->user()->id;
        $users_id = User::find($user_id);
        $salesRecords = SalesRecord::orderBy('id','desc')->get();

        return view('salesrecord.index')->with('salesRecords', $salesRecords)->with('users_id',$users_id);
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
            'action' => 'Created Sales Record',
            'action_by' => $users_id->name,
        ]);
        
        if(!Session::has('cartSalesRecord')) {
            return view('salesrecord.create')->with('users_id',$users_id);
        } else {

            $oldSalesRecordCart = Session::get('cartSalesRecord');
            $salesrecordCart = new CartSalesRecord($oldSalesRecordCart);
            $products = $salesrecordCart->items;

            $totalPrice = 0;

            foreach($products as $product) {
                $totalPrice += $product['qty']*$product['price'];
            }
            
            $salesRecord = new SalesRecord;
            $salesRecord->audit_trails_id = $auditTrail->id;
            $salesRecord->outlets_id = $request->input('outlet');;
            $salesRecord->total_price = $totalPrice;
            $salesRecord->OrderRemarks = $salesrecordCart->remarks;
            $salesRecord->OrderDate = $request->input('salesRecordDate');
            $salesRecord->Location ="";
            $salesRecord->save();

            foreach($products as $product) {
                $salesRecordList = new SalesRecordList;
                $salesRecordList->sales_record_id =$salesRecord['id'];
                $salesRecordList->products_id = $product['item']['id'];
                $salesRecordList->quantity=$product['qty'];
                $salesRecordList->subtotal=$totalPrice;
                $salesRecordList->save();
            }
            Session::forget("cartSalesRecord");
        }

        return redirect('/salesrecord')->with('success', 'Sales Record Created');
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

        $salesRecord = SalesRecord::find($id);
        $salesRecordId = SalesRecord::find($id)->id;
        $records = SalesRecordList::where('sales_record_id', '=', $salesRecordId)->get();
        $totalPrice = DB::table('sales_record_list')->where('sales_record_id', $salesRecordId)->sum('subtotal');

        return view('salesrecord.show')->with('users_id',$users_id)->with('salesRecord',$salesRecord)->with('records',$records)->with('totalPrice',$totalPrice);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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

    public function getSalesRecordAddToCart(Request $request, $id, $price, $quantity, $outlet, $date, $remarks) {
        $product = Products::find($id);
        $oldSalesRecordCart = Session::has('cartSalesRecord') ? Session::get('cartSalesRecord') : null;

        $salesrecordCart = new CartSalesRecord($oldSalesRecordCart);
        $salesrecordCart->add($product, $product->id, $price, $quantity, $outlet, $date, $remarks);

        $request->session()->put('cartSalesRecord', $salesrecordCart);
        
        return redirect()->route('/salesrecord/create/');
    }

    public function getSalesRecordCart() {
        $user_id = auth()->user()->id;
        $users_id = User::find($user_id);

        if(!Session::has('cartSalesRecord')) {
            return view('salesrecord.create')->with('users_id',$users_id);
        } else {
            $oldSalesRecordCart = Session::get('cartSalesRecord');
            $salesrecordCart = new CartSalesRecord($oldSalesRecordCart);

            return view('salesrecord.create', [
                'products' => $salesrecordCart->items
            ])->with('users_id',$users_id);
        }
    }
    
    public function sortDate($startDate,$endDate){
        $salesRecord = SalesRecord::leftJoin('outlets','sales_record.outlets_id','=','outlets.id')
                     ->whereBetween('date',array($startDate,$endDate))
                     ->get()->toArray();

        return response($salesRecord);
    }

    public function exportFile($type){
        $salesrecordexcel = SalesRecordList::leftJoin('sales_record','sales_record_list.sales_record_id','=','sales_record.id')
			  -> leftJoin('products','sales_record_list.products_id','=','products.id')
                          -> select('date', 'remarks', 'Location', 'products.Name as ItemName', 'products.Description as ItemDescription', 'quantity as ItemQuantity', 'products.UnitPrice as ItemUnitPrice')->get()->toArray();

        return \Excel::create('salesrecord', function($excel) use ($salesrecordexcel) {

            $excel->sheet('sheet name', function($sheet) use ($salesrecordexcel)

            {

                $sheet->fromArray($salesrecordexcel);

            });

        })->download($type);

    }
    
    public function getRemoveItem($id) {
        $user_id = auth()->user()->id;
        $users_id = User::find($user_id);
        $oldSalesRecordCart = Session::get('cartSalesRecord');
        $salesrecordCart = new CartSalesRecord($oldSalesRecordCart);
        $salesrecordCart->removeItem($id);
        Session::put('CartSalesRecord', $salesrecordCart);
        if($salesrecordCart->items == null) {
             Session::forget("cartSalesRecord");
        }
        Session::put('cartSalesRecord', $salesrecordCart);
        return view('salesrecord.create', [
                'products' => $salesrecordCart->items
            ])->with('users_id',$users_id);
        
    }

}
