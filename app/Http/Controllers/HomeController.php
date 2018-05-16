<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AuditTrail;
use App\Models\SalesRecord;
use App\User;
use Auth;
use DB;

class HomeController extends Controller
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
        $salesPacks = DB::table('sales_order')->where('statuses_id', 1)->count();
        $salesShips = DB::table('sales_order')->where('statuses_id', 2)->count();
        $salesDelivers = DB::table('sales_order')->where('statuses_id', 3)->count();
        $salesInvoices = DB::table('sales_order')->where('statuses_id', 4)->count();
        $transferPacks = DB::table('transfer_requests')->where('statuses_id', 1)->count();
        $transferShips = DB::table('transfer_requests')->where('statuses_id', 2)->count();
        $transferDelivers = DB::table('transfer_requests')->where('statuses_id', 3)->count();
        $transferInvoices = DB::table('transfer_requests')->where('statuses_id', 4)->count();
        $auditTrails = AuditTrail::orderBy('created_at','desc')->paginate(4);
        $salesRecord = SalesRecord::orderBy('id','asc')->paginate(10);
        
        return view('home')->with('users_id',$users_id)->with('salesPacks', $salesPacks)->
        with('salesShips', $salesShips)->with('salesDelivers', $salesDelivers)->
        with('salesInvoices', $salesInvoices)->with('transferPacks', $transferPacks)->
        with('transferShips', $transferShips)->with('transferDelivers', $transferDelivers)->
        with('transferInvoices', $transferInvoices)->with('auditTrails', $auditTrails)->
        with('salesRecord', $salesRecord);
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
