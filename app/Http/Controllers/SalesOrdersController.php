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
use App\Wholesaler;

class SalesOrdersController extends Controller
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
        $salesOrder = SalesOrder::orderBy('id','asc')->paginate(10);

        return view('salesorder.index')->with('salesOrder', $salesOrder)->with('users_id',$users_id);
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
            
            foreach($products as $product) {
                $salesOrder = new SalesOrder;
                $salesOrder->status_id = 1;
                $salesOrder->status = "pending";
                $salesOrder->remarks = "";
                $salesOrder->audit_trails_id = $auditTrail->id;
                $salesOrder->name = "";
                $salesOrder->email = "";
                $salesOrder->phone_number =  "";
                $salesOrder->shipping_address = "";
                $salesOrder->billing_address = "";
                $salesOrder->sales_order_number = "";
                
                $salesOrder->save();
                
                // {{$product['item']['id']}}
                // {{$product['qty']}}
            }
        }

        return redirect('/salesorder/create')->with('success', 'Sales Order Created');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    public function getSalesOrderAddToCart(Request $request, $id) {
        $product = Products::find($id);
        $oldSalesOrderCart = Session::has('cartSalesOrder') ? Session::get('cartSalesOrder') : null;

        $salesOrderCart = new CartSalesOrder($oldSalesOrderCart);
        $salesOrderCart->add($product, $product->id);

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

            return view('salesorder.create', [
                'products' => $salesOrderCart->items
            ])->with('users_id',$users_id);
        }
    }

}
