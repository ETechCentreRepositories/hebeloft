<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalesRecord;
use App\Models\SalesRecordList;
use App\Models\InventoryOutlet;
use App\Models\Products;
use Session;
use App\User;
use App\CartSalesRecord;

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

        return view('salesrecord.index')->with('users_id',$users_id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_id = auth()->user()->id;
        $users_id = User::find($user_id);

        return view('salesRecord.create')->with('users_id',$users_id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    public function addSalesRecordList($productName){
        $addSalesRecordList = InventoryOutlet::leftJoin('products', 'inventory_has_outlets.products_id', '=', 'products.id')
                    ->leftJoin('outlets', 'inventory_has_outlets.outlets_id', '=', 'outlets.id')
                    ->select('inventory_has_outlets.id','inventory_has_outlets.outlets_id','inventory_has_outlets.products_id','products.Name', 'products.Category','products.Brand', 'products.ItemType','inventory_has_outlets.threshold_level','inventory_has_outlets.stock_level', 'outlets.outlet_name', 'products.UnitPrice', 'products.image')
                    ->where('products.Name','=', $productName)
                    ->get()->toArray();

        $salesRecordList = new SalesRecordList;
        $salesRecordList->products_id = $addSalesRecordList[0]['products_id'];
        $salesRecordList->quantity = 1;
        $salesRecordList->total = $addSalesRecordList[0]['UnitPrice'];
        $salesRecordList->save();
        return view('salesrecord.create')->with('salesRecordList',$salesRecordList);
    }

    public function getInventoryByProductName($productName){
        $inventoryByProductName = InventoryOutlet::leftJoin('products', 'inventory_has_outlets.products_id', '=', 'products.id')
                    ->leftJoin('outlets', 'inventory_has_outlets.outlets_id', '=', 'outlets.id')
                    ->select('inventory_has_outlets.id','inventory_has_outlets.outlets_id','inventory_has_outlets.products_id','products.Name', 'products.Category','products.Brand', 'products.ItemType','inventory_has_outlets.threshold_level','inventory_has_outlets.stock_level', 'outlets.outlet_name', 'products.UnitPrice', 'products.image')
                    ->where('products.Name','=', $productName)
                    ->get()->toArray();

        return response($inventoryByProductName);

        // $addSalesRecordList = InventoryOutlet::leftJoin('products', 'inventory_has_outlets.products_id', '=', 'products.id')
        // ->leftJoin('outlets', 'inventory_has_outlets.outlets_id', '=', 'outlets.id')
        // ->select('inventory_has_outlets.id','inventory_has_outlets.outlets_id','inventory_has_outlets.products_id','products.Name', 'products.Category','products.Brand', 'products.ItemType','inventory_has_outlets.threshold_level','inventory_has_outlets.stock_level', 'outlets.outlet_name', 'products.UnitPrice', 'products.image')
        // ->where('products.Name','=', $productName)
        // ->get()->toArray();

        // $salesRecordList = new SalesRecordList;
        // $salesRecordList->products_id = $addSalesRecordList[0]['products_id'];
        // $salesRecordList->quantity = 1;
        // $salesRecordList->total = $addSalesRecordList[0]['UnitPrice'];
        // $salesRecordList->save();
        // return view('salesrecord.create')->with('salesRecordList',$salesRecordList);
    }

    public function getSalesRecordAddToCart(Request $request, $id) {
        $product = Products::find($id);
        $oldSalesRecordCart = Session::has('cartSalesRecord') ? Session::get('cartSalesRecord') : null;
        $salesrecordCart = new CartSalesRecord($oldSalesRecordCart);
        $salesrecordCart->add($product, $product->$id);

        $request->session()->put('cartSalesRecord', $salesrecordCart);
        // dd($request->session()->get('cartSalesRecord'));
        return console.log('testing');
    }

    // public function retrieveItemBySalesId($salesRecordId){
    //     $retrieveItemBySalesId = SalesRecordList::leftJoin('sales_record', 'sales_record_list.sales_record_id', '=', 'sales_record.id')
    //                 ->leftJoin('products', 'sales_record_list.products_id', '=', 'products.id')
    //                 ->where('sales_record_list.sales_record_id','=', $salesRecordId)
    //                 ->get()->toArray();
    //     return response($retrieveItemBySalesId);
    //     return view('salesrecord.create')->with('items',$retrieveItemBySalesId);
    // }
}
