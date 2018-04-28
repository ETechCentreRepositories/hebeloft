<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalesRecord;
use App\Models\SalesRecordList;
use App\Models\InventoryOutlet;

class SalesRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('salesRecord.create');
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

        $salesRecord = new SalesRecord;
        $salesRecord->save();
        $salesRecordList = new SalesRecordList;
        $salesRecordList->sales_record_id = $salesRecord->id;
        $salesRecordList->products_id = $addSalesRecordList[0]['products_id'];
        $salesRecordList->quantity = 1;
        // $salesRecordList->discount ;
        $salesRecordList->total = $addSalesRecordList[0]['UnitPrice'];
        $salesRecordList->save();
        return response($salesRecord->id);
    }
}
