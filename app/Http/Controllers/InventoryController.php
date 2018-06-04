<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
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
        $inventoryOutlets = InventoryOutlet::orderBy('id','desc')->paginate(10);
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
    	$request->file('inventory_csv')->move(public_path(), "inventory.csv");
    	if (($handle = fopen ( public_path () . '/inventory.csv', 'r' )) !== FALSE) {
            while ( ($data = fgetcsv ( $handle, 1000, ',' )) !== FALSE ) {
                $csv_data = new Products ();
                $csv_data->Name = $data [0];
                $csv_data->save();
            }
            fclose ( $handle );
            $finalData = $csv_data::all ();
            return redirect('/')->with('success', 'Success');
        } else {
            return redirect('/')->with('fail', 'Fail');
        }
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
        $inventoryOutlet = InventoryOutlet::orderBy('id', 'desc')->get()->toArray();

        return response($inventoryOutlet);
    }
    
    public function getOutlet(){
        $outlets = Outlet::orderBy('id', 'desc')->get()->toArray();

        return response($outlets);
    }
    
    public function getProductBrand(){
        $productBrand = Products::orderBy('id', 'desc')->get()->toArray();

        return response($productBrand);
    }

    public function search(Request $request){
        $search = $request->keyword;
        $inventoryOutlets = InventoryOutlet::join('products', 'inventory_has_outlets.products_id', '=', 'products.id')
                            ->join('outlets', 'inventory_has_outlets.outlets_id', '=', 'outlets.id')
                            ->where('Name','LIKE', "%".$search.'%')
                            ->where('outlets_id', '=', 13)
                            ->get();
        $data = [];

        foreach($inventoryOutlets as $key => $value){
            $data [] = ['id' => $value->id, 'value'=>$value->Name];
        }
        return response($data);    
    }
    public function getInventoryByFilter($outlet, $product_brand){
        $inventoryByFilter = InventoryOutlet::leftJoin('products', 'inventory_has_outlets.products_id', '=', 'products.id')
                    ->leftJoin('outlets', 'inventory_has_outlets.outlets_id', '=', 'outlets.id')
                    ->select('inventory_has_outlets.id','inventory_has_outlets.outlets_id','inventory_has_outlets.products_id','products.Name', 'products.Category','products.Brand', 'products.ItemType','inventory_has_outlets.threshold_level','inventory_has_outlets.stock_level', 'outlets.outlet_name', 'products.UnitPrice', 'products.image')
                    ->where('inventory_has_outlets.outlets_id','=',$outlet)
                    ->where('products.id','=',$product_brand)
                    ->get()->toArray();

        return response($inventoryByFilter);
    }

    public function getInventoryByProductName($productName){
        $inventoryByProductName = InventoryOutlet::leftJoin('products', 'inventory_has_outlets.products_id', '=', 'products.id')
                    ->leftJoin('outlets', 'inventory_has_outlets.outlets_id', '=', 'outlets.id')
                    ->select('inventory_has_outlets.id','inventory_has_outlets.outlets_id','inventory_has_outlets.products_id','products.Name', 'products.Category','products.Brand', 'products.ItemType','inventory_has_outlets.threshold_level','inventory_has_outlets.stock_level', 'outlets.outlet_name', 'products.UnitPrice', 'products.image')
                    ->where('products.Name','=', $productName)
                    ->where('outlets_id', '=', 13)
                    ->distinct()
                    ->get()->toArray();

        return response($inventoryByProductName);
    }
    
    public function getInventoryByProductBrand($product_brand){
        $inventoryByOutlet = InventoryOutlet::leftJoin('products', 'inventory_has_outlets.products_id', '=', 'products.id')
                    ->leftJoin('outlets', 'inventory_has_outlets.outlets_id', '=', 'outlets.id')
                    ->select('inventory_has_outlets.id','inventory_has_outlets.outlets_id','inventory_has_outlets.products_id','products.Name', 'products.Category','products.Brand', 'products.ItemType','inventory_has_outlets.threshold_level','inventory_has_outlets.stock_level', 'outlets.outlet_name', 'products.UnitPrice', 'products.image')
                    ->where('products.id','=',$product_brand)
                    ->get()->toArray();

        return response($inventoryByOutlet);
    }
    
    public function getInventoryByProductBrandforWholesaler($product_brand){
        $inventoryByOutlet = InventoryOutlet::leftJoin('products', 'inventory_has_outlets.products_id', '=', 'products.id')
                    ->leftJoin('outlets', 'inventory_has_outlets.outlets_id', '=', 'outlets.id')
                    ->select('inventory_has_outlets.id','inventory_has_outlets.outlets_id','inventory_has_outlets.products_id','products.Name', 'products.Category','products.Brand', 'products.ItemType','inventory_has_outlets.threshold_level','inventory_has_outlets.stock_level', 'outlets.outlet_name', 'products.UnitPrice', 'products.image')
                    ->where('products.id','=',$product_brand)
                    ->where('outlets_id','=', 13)
                    ->get()->toArray();

        return response($inventoryByOutlet);
    }
    
    public function getInventoryByOutlet($outlet){
        $inventoryByOutlet = InventoryOutlet::leftJoin('products', 'inventory_has_outlets.products_id', '=', 'products.id')
                    ->leftJoin('outlets', 'inventory_has_outlets.outlets_id', '=', 'outlets.id')
                    ->select('inventory_has_outlets.id','inventory_has_outlets.outlets_id','inventory_has_outlets.products_id','products.Name', 'products.Category','products.Brand', 'products.ItemType','inventory_has_outlets.threshold_level','inventory_has_outlets.stock_level', 'outlets.outlet_name', 'products.UnitPrice', 'products.image')
                    ->where('outlets.id','=',$outlet)
                    ->get()->toArray();

        return response($inventoryByOutlet);
    }

}
