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

use DB;

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
        $transferRequests = TransferRequest::orderBy('id','asc')->paginate(10);

        return view('transfer_request.index')->with('transferRequests', $transferRequests)->with('users_id',$users_id);
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

            $transfers = new TransferRequest;
            $transfers->audit_trails_id = $auditTrail->id;
            $transfers->status_id = 1;
            $transfers->status="pending";
            $transfers->from_location = "";
            $transfers->remarks = "";
            $transfers->save();

            foreach($products as $product) {
                $transferRequestList = new TransferRequestList;
                $transferRequestList->transfer_requests_id =$transfers['id'];
                $transferRequestList->products_id = $product['item']['id'];
                $transferRequestList->quantity=$product['qty'];
                $transferRequestList->save();
            }

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
        $transferRequestId = TransferRequest::find($id)->id;
        $transferRequests = TransferRequestList::where('transfer_requests_id', $transferRequestId)->get();

        return view('transfer_request.show')->with('transferRequests',$transferRequests)->with('users_id',$users_id);
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
