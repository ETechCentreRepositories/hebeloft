<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Products;

use Illuminate\Http\Request;

class PurchaseOrdersController extends Controller
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
        $product = Products::orderBy('id','asc')->get();
        
        return view('purchaseorder.index')->with('users_id',$users_id)->with('products',$product);
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
        
        return view('purchaseorder.create')->with('users_id',$users_id);
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

        if($request->hasFile('image')){
            $fileNameWithExt = $request->file('image')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            $path = $request->file('image')->storeAs('public/product_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'no_image.jpg';
        }

        $product = new Products;
        $product->Name = $request->input("name");
        $product->Category = $request->input("category");
        $product->Remarks = $request->input("remarks");
        $product->Brand = $request->input("brand");
        $product->UnitPrice = $request->input("unitPrice");
        $product->Size = $request->input("size");
        $product->OG_PLU = $request->input("og");
        $product->BHG = $request->input("bhg");
        $product->Metro = $request->input("metro");
        $product->Robinsons = $request->input("robinson");
        $product->NTUC = $request->input("ntuc");
        $product->Description = $request->input("description");
        $product->image = $request->input("image_add");
        $product->Unit = $request->input("unit");
        $product->ProductLength = $request->input("length");
        $product->ProductWeight = $request->input("weight");
        $product->ProductHeight = $request->input("height");
        $product->ProductWidth = $request->input("width");
        $product->Cost = $request->input("cost");
        $product->LastVendor = $request->input("lastVendor");
        $product->VendorPrice = $request->input("vendorPrice");
        $product->Barcode = $request->input("barcode");
        $product->image = $fileNameToStore;
        //stock level & threshold level
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
