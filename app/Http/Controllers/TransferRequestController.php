<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransferRequest;
use App\User;
use App\Models\Product;


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
        $this->validate($request, [
            'outlet_name' => 'required',
            'address' => 'required',
            'email' => 'required',
            'telephone_number' => 'required',
            'fax' => 'required',
        ]);

        // Create Request
        // $transfers = new Outlet;
        // $transfers->outlet_name = $request->input('outlet_name');
        // $transfers->address = $request->input('address');
        // $transfers->email = $request->input('email');
        // $transfers->telephone_number = $request->input('telephone_number');
        // $transfers->fax = $request->input('fax');
        // $transfers->save();

        $product_name = $request->input('product_name');

        return redirect('/outlet')->with('success', 'Outlet Created');
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
        $this->validate($request, [
            'outlet_name' => 'required',
            'address' => 'required',
            'email' => 'required',
            'telephone_number' => 'required',
            'fax' => 'required',
        ]);

        // Create Request
        // $outlet = Outlet::find($id);
        // $outlet->outlet_name = $request->input('outlet_name');
        // $outlet->address = $request->input('address');
        // $outlet->email = $request->input('email');
        // $outlet->telephone_number = $request->input('telephone_number');
        // $outlet->fax = $request->input('fax');
        // $outlet->save();

        return redirect('/transfer_request')->with('success', 'Request Updated');
    }

    /**
     * Remove the specified resource from storage.
     *git 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transfers = TransferRequest::find($id);
        $transfers->delete();

        return redirect('/transfer_request')->with('success', 'Request Removed');
    }
}
