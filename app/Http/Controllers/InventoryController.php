<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Inventory;
use App\Models\InventoryOutlet;
use App\Models\Outlet;
use App\User;
use Auth;

use DB;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user_id = auth()->user()->id;
        $users_id = User::find($user_id);
        $inventoryOutlets = InventoryOutlet::orderBy('id','asc')->paginate(10);
        // $products = Products::all();
        return view('inventory.index')->with('inventoryOutlets',$inventoryOutlets)->with('users_id',$users_id);
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

        $inventoryexcel = InventoryOutlet::join('products', 'inventory_has_outlets.products_id', '=', 'products.id')
                        ->select('inventory_has_outlets.id','products.Name', 'products.Category', 'products.ItemType','inventory_has_outlets.threshold_level','inventory_has_outlets.stock_level')
                        ->get()->toArray();

        return \Excel::create('inventory', function($excel) use ($inventoryexcel) {

            $excel->sheet('sheet name', function($sheet) use ($inventoryexcel)

            {

                $sheet->fromArray($inventoryexcel);

            });

        })->download($type);

    }      
    
    public function getInventory(){
        $inventory = InventoryOutlet::leftJoin('products', 'inventory_has_outlets.products_id', '=', 'products.id')
                     ->leftJoin('outlets', 'inventory_has_outlets.outlets_id', '=', 'outlets.id')
                     ->select('inventory_has_outlets.id','inventory_has_outlets.outlets_id','inventory_has_outlets.products_id','products.Name', 'products.Category','products.Brand', 'products.ItemType','inventory_has_outlets.threshold_level','inventory_has_outlets.stock_level', 'outlets.outlet_name')
                    //  ->where('products.Category','=', 'orange')
                     ->get()->toArray();

        return response($inventory);
    }

    public function getInventoryById($inventoryId){
        $inventoryById = DB::table('inventory_has_outlets')  
                        ->join('products', 'inventory_has_outlets.products_id', '=', 'products.id')
                        ->select('inventory_has_outlets.id','products.Name', 'products.Category','products.Brand', 'products.ItemType','inventory_has_outlets.threshold_level','inventory_has_outlets.stock_level')
                        ->where('inventory_has_outlets.inventory_id', $inventoryId)
                        ->get()->toArray();

        return response($inventoryById);
    }

    public function getOutletByInventory(){
        $inventoryByOutlet = InventoryOutlet::join('products', 'inventory_has_outlets.products_id', '=', 'products.id')
                        ->join('outlets', 'inventory_has_outlets.outlets_id', '=', 'outlets.id')
                        // ->where('outlet_name','LIKE','%'.$search.'%')
                        ->get();
                        
        return response($inventoryByOutlet);
    }

    public function getOutlet(){
        $inventoryOutlets = Outlet::get()->toArray();

        return response($inventoryOutlets);
    }

    public function search(Request $request){
        $search = $request->keyword;
        $inventoryOutlets = InventoryOutlet::join('products', 'inventory_has_outlets.products_id', '=', 'products.id')
                            ->join('outlets', 'inventory_has_outlets.outlets_id', '=', 'outlets.id')
                            // ->where('outlet_name','LIKE','%'.$search.'%')
                            ->where('Name','LIKE', "%".$search.'%')
                            ->get();
        $data = [];

        foreach($inventoryOutlets as $key => $value){
            $data [] = ['id' => $value->id, 'value'=>$value->Name];
        }
        return response($data);    
    }
    public function getInventoryByOutlet($outlet){
        $inventoryByOutlet = InventoryOutlet::leftJoin('products', 'inventory_has_outlets.products_id', '=', 'products.id')
                    ->leftJoin('outlets', 'inventory_has_outlets.outlets_id', '=', 'outlets.id')
                    ->select('inventory_has_outlets.id','inventory_has_outlets.outlets_id','inventory_has_outlets.products_id','products.Name', 'products.Category','products.Brand', 'products.ItemType','inventory_has_outlets.threshold_level','inventory_has_outlets.stock_level', 'outlets.outlet_name', 'products.UnitPrice', 'products.image')
                    ->where('inventory_has_outlets.outlets_id','=',$outlet)
                    ->get()->toArray();

        return response($inventoryByOutlet);
    }

    public function getInventoryByProductName($productName){
        $inventoryByProductName = InventoryOutlet::leftJoin('products', 'inventory_has_outlets.products_id', '=', 'products.id')
                    ->leftJoin('outlets', 'inventory_has_outlets.outlets_id', '=', 'outlets.id')
                    ->select('inventory_has_outlets.id','inventory_has_outlets.outlets_id','inventory_has_outlets.products_id','products.Name', 'products.Category','products.Brand', 'products.ItemType','inventory_has_outlets.threshold_level','inventory_has_outlets.stock_level', 'outlets.outlet_name', 'products.UnitPrice', 'products.image')
                    ->where('products.Name','=', $productName)
                    ->get()->toArray();

        return response($inventoryByProductName);
    }
}
