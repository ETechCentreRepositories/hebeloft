<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Outlet;

class OutletsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $outlets = Outlet::all();
        return view('outlets.index')->with('outlets', $outlets);
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

        // Create Outlet
        $outlet = new Outlet;
        $outlet->outlet_name = $request->input('outlet_name');
        $outlet->address = $request->input('address');
        $outlet->email = $request->input('email');
        $outlet->telephone_number = $request->input('telephone_number');
        $outlet->fax = $request->input('fax');
        $outlet->save();

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
        $outlet = Outlet::find($id);
        return view('outlets.edit')->with('outlet', $outlet);
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

        // Create Outlet
        $outlet = Outlet::find($id);
        $outlet->outlet_name = $request->input('outlet_name');
        $outlet->address = $request->input('address');
        $outlet->email = $request->input('email');
        $outlet->telephone_number = $request->input('telephone_number');
        $outlet->fax = $request->input('fax');
        $outlet->save();

        return redirect('/outlet')->with('success', 'Outlet Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $outlet = Outlet::find($id);
        $outlet->delete();

        return redirect('/outlet')->with('success', 'Outlet Removed');
    }
}
