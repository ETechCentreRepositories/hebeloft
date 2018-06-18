<?php

namespace App\Http\Controllers;

use App\User;
use App\PurchaseOrder;
use App\Models\AuditTrail;

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
        $product = PurchaseOrder::orderBy('id','asc')->get();
        
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
        $user_id = auth()->user()->id;
        $users_id = User::find($user_id);

        //Get the login user
        $login_user_id = auth()->user()->id;
        $login_user = User::find($login_user_id);
 
        //Audit Trail
        $auditTrail = AuditTrail::create([
            'action' => 'Created Purchase Order',
            'action_by' => $login_user->name,
        ]);

        $product = new PurchaseOrder;
        $product->statuses_id = 1;
        $product->status = "pending";
        $product->date = $request->input("#purchaseOrderdate");
        $product->remarks = $request->input("remarks");
        $product->audit_trails_id = $auditTrail->id;
        $product->totalQuantity = 10;
        $product->totalPrice = 10;
        $product->save();

        return redirect('/purchaseorder')->with('success', 'Successfully Added a New Purchase Order');
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
        $user_id = auth()->user()->id;
        $users_id = User::find($user_id); 

        $salesOrders = PurchaseOrder::find($id);

        return view('purchaseorder.edit')->with('users_id',$users_id)->with('salesOrders',$salesOrders);
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
        $login_user_id = auth()->user()->id;
        $login_user = User::find($login_user_id);

        //Audit Trail
        $auditTrail = AuditTrail::create([
            'action' => 'Deleted Purchase Order',
            'action_by' => $login_user->name,
        ]);

        $product = PurchaseOrder::find($id);
        $product->delete();
        return redirect('/purchaseorder')->with('success', 'Successfully Deleted Product');
    }

    public function exportFile($type){

        $product = PurchaseOrder::orderBy('id','asc')->get();

        return \Excel::create('purchase_order', function($excel) use ($product) {
            $excel->sheet('sheet name', function($sheet) use ($product)
            {
                $sheet->fromArray($product);
            });
        })->download($type);
    }
}
