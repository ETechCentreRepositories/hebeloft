<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\User;
use App\Models\AuditTrail;
use DB;

class ProductsController extends Controller
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
        $product = Products::orderBy('id','asc')->paginate(10);
        
        return view('product.index')->with('users_id',$users_id)->with('products',$product);
    }
    public function add()
    {
        $user_id = auth()->user()->id;
        $users_id = User::find($user_id);
        
        return view('product.add')->with('users_id',$users_id);
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
         //Get the login user
         $login_user_id = auth()->user()->id;
         $login_user = User::find($login_user_id);
 
         //Audit Trail
         $auditTrail = AuditTrail::create([
             'action' => 'Created Outlet Staff',
             'action_by' => $login_user->name,
         ]);

         $product = new Products;
         $product->Name = $request->input("name");
         $product->Category = $request->input("category");
         $product->Brand = $request->input("brand");
         $product->UnitPrice = $request->input("unitPrice");
         $product->Size = $request->input("size");
         $product->OG_PLU = $request->input("ogplu");
         $product->BHG = $request->input("bhg");
         $product->Metro = $request->input("metro");
         $product->Robinsons = $request->input("robinson");
         $product->NTUC = $request->input("ntuc");
         $product->Description = $request->input("Description");
         $product->save();

         return redirect('/product')->with('success', 'Successfully Created a New Product');
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
}
