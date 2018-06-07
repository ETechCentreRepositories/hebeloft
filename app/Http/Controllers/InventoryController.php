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
            $productNames = [];
            $locations = [];
            $quantitys = [];
            while (($data = fgetcsv ( $handle, 1000, ',' )) !== FALSE ) {
                // dd($this->getIdByProductName($data[0]));
                $getID = [];
                $getID = $this->getIdByProductName($data[0]);
                $gettingID = array_get($getID, 0);
                $arrayId = (array) $gettingID;
                array_push($productNames, array_get($arrayId, "id"));
                // array_push($locations, $data[1]);
                // array_push($quantitys, $data[4]);
                // //find product_id by name
                // //find outlet_id by name
                
                // $inventoryOutlet = new InventoryOutlet ();
                // $inventoryOutlet->products_id = $this->getIdByProductName($data[0]);
                // $inventoryOutlet->stock_level = $this->getIdByOutlet($data[4]);
                // $inventoryOutlet->save();
            }
            dd($productNames);

            fclose ( $handle );
            $finalData = $inventoryOutlet::all ();
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

    public function getInventoryByProductBrand($product_brand){
        $inventoryByOutlet = InventoryOutlet::leftJoin('products', 'inventory_has_outlets.products_id', '=', 'products.id')
                    ->leftJoin('outlets', 'inventory_has_outlets.outlets_id', '=', 'outlets.id')
                    ->select('inventory_has_outlets.id','inventory_has_outlets.outlets_id','inventory_has_outlets.products_id','products.Name', 'products.Category','products.Brand', 'products.ItemType','inventory_has_outlets.threshold_level','inventory_has_outlets.stock_level', 'outlets.outlet_name', 'products.UnitPrice', 'products.image')
                    ->where('inventory_has_outlets.id','=',$product_brand)
                    ->get()->toArray();

        return response($inventoryByOutlet);
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

    public function getIdByOutlet($outlet){
        
        $idByOutletName = DB::table('outlets')->select('id')->where('outlet_name', $outlet)->get();

        return $idByOutletName;
    }

    public function getIdByProductName($productName){

        $idByProductName = DB::table('products')->select('id')->where('Name', $productName)->get();

        return $idByProductName;
    }

}
