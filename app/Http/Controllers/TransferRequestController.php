<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransferRequest;
use App\Models\TransferRequestList;
use App\User;
use App\Models\Status;
use App\Models\AuditTrail;
use App\Models\Products;
use Session;
use App\CartTransferRequest;

class TransferRequestController extends Controller
{
    protected $transferRequest;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $users_id = User::find($user_id);
        $transfers = TransferRequest::orderBy('id','asc')->paginate(10);

        return view('transfer_request.index')->with('transfers', $transfers)->with('users_id',$users_id);
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
        // $login_user_id = auth()->user()->id;
        // $login_user = User::find($login_user_id);

        // Audit Trail
        // $auditTrail = AuditTrail::create([
        //     'action' => 'Created Transfer Request',
        //     'action_by' => $login_user->name,
        // ]);

        // $this->validate($request, [
        //     'outlet_name' => 'required',
        //     'address' => 'required',
        //     'email' => 'required',
        //     'telephone_number' => 'required',
        //     'fax' => 'required',
        // ]);

        // // Create Request
        // // $transfers = new Outlet;
        // // $transfers->outlet_name = $request->input('outlet_name');
        // // $transfers->address = $request->input('address');
        // // $transfers->email = $request->input('email');
        // // $transfers->telephone_number = $request->input('telephone_number');
        // // $transfers->fax = $request->input('fax');
        // // $transfers->save();

        // $product_name = $request->input('product_name');

        // return redirect('/outlet')->with('success', 'Outlet Created');

        $user_id = auth()->user()->id;
        $users_id = User::find($user_id);

        //Audit Trail
        $auditTrail = AuditTrail::create([
            'action' => 'Created Transfer Request',
            'action_by' => $users_id->name,
        ]);
        

        if(!Session::has('cartTransferRequest')) {
            return view('transfer_request.create')->with('users_id',$users_id);
        } else {

            $oldTransferRequestCart = Session::get('cartTransferRequest');
            $transferRequestCart = new CartTransferRequest($oldTransferRequestCart);
            $products = $transferRequestCart->items;
            
            foreach($products as $product) {
                $transfers = new TransferRequest;
                $transfers->audit_trails_id = $auditTrail->id;
                $transfers->status_id = 1;
                $transfers->from_location = "";
                $transfers->remarks = "";
                $transfers->save();
                // {{$product['item']['id']}}
                // {{$product['qty']}}
            }

            // $transferRequestList = TransferRequestList::create([
            //     'transfer_requests_id' => 'Created Transfer Request',
            //     'products_id' => $login_user->name,
            // ]);

        }

        return redirect('/transferrequest/create')->with('success', 'Transfer Request Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user_id = auth()->user()->id;
        $users_id = User::find($user_id);
        $transferRequestId = TransferRequest::find($id);
        $transferQuantity = DB::table('transfer_requests')->where('status_id', 3);

        return view('transfer_request.show')->with('transferRequest', $transferRequest)->with('users_id',$users_id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $outlet = Outlet::find($id);
        return view('transfer_request.edit')->with('transfers', $transfers);
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
        $login_user_id = auth()->user()->id;
        $login_user = User::find($login_user_id);

        //Audit Trail
        $auditTrail = AuditTrail::create([
            'action' => 'Updated Transfer Request',
            'action_by' => $login_user->name,
        ]);

        $this->validate($request, [
            'outlet_name' => 'required',
            'address' => 'required',
            'email' => 'required',
            'telephone_number' => 'required',
            'fax' => 'required',
        ]);

        return redirect('/transferrequest')->with('success', 'Request Updated');
    }

    /**
     * Remove the specified resource from storage.
     *git 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $login_user_id = auth()->user()->id;
        $login_user = User::find($login_user_id);

        //Audit Trail
        $auditTrail = AuditTrail::create([
            'action' => 'Deleted Transfer Request',
            'action_by' => $login_user->name,
        ]);

        $transfers = TransferRequest::find($id);
        $transfers->delete();

        return redirect('/transferrequest')->with('success', 'Request Removed');
    }

    public function getTransferRequestAddToCart(Request $request, $id) {
        $product = Products::find($id);
        $oldTransferRequestCart = Session::has('cartTransferRequest') ? Session::get('cartTransferRequest') : null;

        $transferRequestCart = new CartTransferRequest($oldTransferRequestCart);
        $transferRequestCart->add($product, $product->id);

        $request->session()->put('cartTransferRequest', $transferRequestCart);
        
        return redirect()->route('/transferrequest/create/');
    }

    public function getTransferRequestCart() {
        $user_id = auth()->user()->id;
        $users_id = User::find($user_id);

        if(!Session::has('cartTransferRequest')) {
            return view('transfer_request.create')->with('users_id',$users_id);
        } else {
            $oldTransferRequestCart = Session::get('cartTransferRequest');
            $transferRequestCart = new CartTransferRequest($oldTransferRequestCart);
            return view('transfer_request.create', [
                'products' => $transferRequestCart->items
            ])->with('users_id',$users_id);
        }
    }
}
