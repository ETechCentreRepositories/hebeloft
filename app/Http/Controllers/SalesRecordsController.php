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
        $salesRecord = SalesRecord::orderBy('id','asc')->paginate(10);

        return view('salesrecord.index')->with('salesRecord', $salesRecord)->with('users_id',$users_id);
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
            
            foreach($products as $product) {
                $salesRecord = new SalesRecord;
                $salesRecord->audit_trails_id = $auditTrail->id;
                $salesRecord->outlets_id = 1;
                $salesRecord->total_price = 1;
                $salesRecord->remarks = "";
                $salesRecord->save();

                
                // {{$product['item']['id']}}
                // {{$product['qty']}}
            }
        }

        return redirect('/salesrecord/create')->with('success', 'Sales Request Created');
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

    public function getSalesRecordAddToCart(Request $request, $id) {
        $product = Products::find($id);
        $oldSalesRecordCart = Session::has('cartSalesRecord') ? Session::get('cartSalesRecord') : null;

        $salesrecordCart = new CartSalesRecord($oldSalesRecordCart);
        $salesrecordCart->add($product, $product->id);

        $request->session()->put('cartSalesRecord', $salesrecordCart);
        
        return redirect()->route('/salesrecord/create/');
    }

    public function getSalesRecordCart() {
        $user_id = auth()->user()->id;
        $users_id = User::find($user_id);

        if(!Session::has('cartSalesRecord')) {
            return view('salesRecord.create')->with('users_id',$users_id);
        } else {
            $oldSalesRecordCart = Session::get('cartSalesRecord');
            $salesrecordCart = new CartSalesRecord($oldSalesRecordCart);

            return view('salesRecord.create', [
                'products' => $salesrecordCart->items
            ])->with('users_id',$users_id);
        }
    }

}
