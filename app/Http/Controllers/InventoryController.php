<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Inventory;
use App\Models\InventoryOutlet;
use App\Models\Outlet;

use DB;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inventoryOutlets = InventoryOutlet::orderBy('id','asc')->paginate(10);;
        // $products = Products::all();
        return view('inventory.index')->with('inventoryOutlets',$inventoryOutlets);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

       /**

     * Create a new controller instance.

     *

     * @return void

     */

    public function importFile(Request $request){

        if($request->hasFile('sample_file')){

            $path = $request->file('sample_file')->getRealPath();

            $data = \Excel::load($path)->get();



            if($data->count()){

                foreach ($data as $key => $value) {

                    $arr[] = ['title' => $value->title, 'body' => $value->body];

                }

                if(!empty($arr)){

                    DB::table('products')->insert($arr);

                    dd('Insert Recorded successfully.');

                }

            }

        }

        dd('Request data does not have any files to import.');      

    }

        /**

     * Create a new controller instance.

     *

     * @return void

     */

    public function exportFile($type){

        $inventoryexcel = Inventory::join('products', 'inventory.products_id', '=', 'products.id')
                        ->select('inventory.id','products.Name', 'products.Category', 'products.ItemType','inventory.threshold_level','inventory.stock_level')
                        ->get()->toArray();

        return \Excel::create('inventory', function($excel) use ($inventoryexcel) {

            $excel->sheet('sheet name', function($sheet) use ($inventoryexcel)

            {

                $sheet->fromArray($inventoryexcel);

            });

        })->download($type);

    }      
    
    public function getInventory(){
        $inventory = InventoryOutlet::join('products', 'inventory_has_outlets.products_id', '=', 'products.id')
                     ->join('outlets', 'inventory_has_outlets.outlets_id', '=', 'outlets.id')
                     ->select('inventory_has_outlets.id','products.Name', 'products.Category','products.Brand', 'products.ItemType','inventory_has_outlets.threshold_level','inventory_has_outlets.stock_level', 'outlets.outlet_name')
                     ->get()->toArray();

        return response($inventory);
    }

    public function getInventoryById($inventoryById){
        $inventoryById = DB::table('inventory_has_outlets')  
                        ->join('products', 'inventory_has_outlets.products_id', '=', 'products.id')
                        ->select('inventory_has_outlets.id','products.Name', 'products.Category','products.Brand', 'products.ItemType','inventory_has_outlets.threshold_level','inventory_has_outlets.stock_level')
                        // ->where('inventory_has_outlets.inventory_id' , $inventoryId)
                        ->get()->toArray();

        return response($inventoryById);
    }

        public function getOutlet(){
        $inventory = Outlet::get()->toArray();

        return response($inventory);
    }
}
