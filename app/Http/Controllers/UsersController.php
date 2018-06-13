<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\UserOutlet;
use App\Models\Wholesaler;
use App\Models\Outlet;
use App\Models\Role;
use App\Models\AuditTrail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use DB;


class UsersController extends Controller
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
        $users =User::orderBy('created_at','asc')->get();
        $admins =User::orderBy('created_at','asc')->where('roles_id', '=', '2')->get();
        $staffs =User::orderBy('created_at','asc')->where('roles_id', '=', '3')->get();
        $wholesalers =User::orderBy('created_at','asc')->where('roles_id', '=', '4')->get();
        $outlets = Outlet::all();
        return view('user.index')->with('users', $users)->with('outlets',$outlets)->with('users_id',$users_id)->with('admins',$admins)->with('staffs',$staffs)->with('wholesalers',$wholesalers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $outlets = Outlet::all();
        return view('user.staffsignup')->with('outlets',$outlets);
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

        // Create Internal User
        $role = $request->input('role');
        
        if($role == 3) {
	        $user = new User;
	        $user->roles_id = "3";
	        $user->name = $request->input('username');
	        $user->email = "";
	        $user->phone_number = $request->input('phone_number');
	        $user->password = Hash::make($request->input('password'));
	        $user->save();
	
	        $outlets = $request->outlet; 
	        $num_outlet = count($outlets);
	        for($i = 0 ; $i < $num_outlet ; $i++){
	            // echo "<br>". $outlets[$i];
	            $userOutlet = new UserOutlet;
	            $userOutlet->users_id = $user->id;
	            $userOutlet->outlets_id = $outlets[$i];
	            $userOutlet->audit_trails_id = $auditTrail->id;
	            $userOutlet->save();
	        }
	        
	        return redirect('/user')->with('success', 'Successfully Registered a New Staff');
        } else if ($role == 2){
        	$user = new User;
	        $user->roles_id = "2";
	        $user->name = $request->input('adminUsername');
	        $user->email = "enquiry@hebeloft.com";
	        $user->phone_number = $request->input('adminPhoneNumber');
	        $user->password = Hash::make($request->input('adminPassword'));
	        $user->save();
	        return redirect('/user')->with('success', 'Successfully Registered a New Admin');
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
        // return view('user.staffsignup')->with('id',$id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::find($id);
        $user_id = auth()->user()->id;
        $users_id = User::find($user_id);
        $outlets = Outlet::all();
        $roles = Role::all();

        return view('user.edit')->with('id',$id)->with('users', $users)->with('outlets',$outlets)->with('roles', $roles)->with('users_id',$users_id);
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
            'action' => 'Updated Outlet Staff',
            'action_by' => $login_user->name,
        ]);

        $users = User::find($id);
        $users->name = $request->input('name');
        $users->roles_id = $request->input('roles_id');
        $users->password = Hash::make($request->input('password'));

        $users->save();

        $userOutletExists = UserOutlet::where('users_id', $id)->get();
        if($userOutletExists){
            foreach($userOutletExists as $userOutletExist){
                $userOutletExist->delete();
            }
        }

        // $outlets = $request->outlet; 
        // $num_outlet = count($outlets);
        // for($i = 0 ; $i < $num_outlet ; $i++){
        //     $userOutlet = new UserOutlet;
        //     $userOutlet->users_id = $id;
        //     $userOutlet->outlets_id = $outlets[$i];
        //     $userOutlet->save();
        // }

        return redirect('/user')->with('success', 'User Updated');
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

        // $userOutlet = UserOutlet::find("users_id");
        // dd($userOutlet);
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
    
    public function exportFile($type){

        $userexcel = User::select('id','name','email','phone_number')->get()->toArray();

        return \Excel::create('user', function($excel) use ($userexcel) {

            $excel->sheet('sheet name', function($sheet) use ($userexcel)

            {

                $sheet->fromArray($userexcel);

            });

        })->download($type);

    }
}
