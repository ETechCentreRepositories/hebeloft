<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DeleteOutletsController extends Controller
{
    public function index()
    {
        $user_id = auth()->user()->id;
        $users_id = User::find($user_id);
        $outlets = Outlet::orderBy('id','asc')->get();
        $userOutlets = UserOutlet::all();
        
        return view('outlets.index')->with('outlets', $outlets)->with('users_id',$users_id)->with('userOutlets',$userOutlets);
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
            'action' => 'Deleted Outlet Staff',
            'action_by' => $login_user->name,
        ]);

        $userOutletExists = UserOutlet::where('users_id',$id)->get();
        $wholesalerExists = Wholesaler::where('users_id',$id)->get();

        if($userOutletExists){
            foreach($userOutletExists as $userOutletExist){
                $userOutletExist->delete();
            }
        }

        if($wholesalerExists){
            foreach($wholesalerExists as $wholesalerExist){
                $wholesalerExist->delete();
            }
        }

        $user = User::find($id);
        $user->delete();
        return redirect('/user')->with('success', 'User Removed');
    }
}
