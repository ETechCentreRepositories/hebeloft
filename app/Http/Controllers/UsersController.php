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
        $users =User::orderBy('created_at','asc')->paginate(10);
        // $user = User::find($id);
        // $user_id = $users->id;
        $outlets = Outlet::all();
        // $userOutlets = DB::select('SELECT outlets_id FROM users_has_outlets WHERE users_id ='. $user_id);

        // $roles = Role::select('id', 'roles_name')->get();
        // foreach ($roles as $role) {
        //     $roleList[$role->id] = $role->roles_name;
        // }

        // return view('user.index', compact('roleList'))->with('users', $users)->with('outlets',$outlets)->with('users_id',$users_id);
        return view('user.index')->with('users', $users)->with('outlets',$outlets)->with('users_id',$users_id);
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
        $role = 3;
        $user = new User;
        $user->roles_id = $role;
        $user->name = $request->input('username');
        $user->email = $request->input('email');
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
        
        return redirect('/user')->with('success', 'User Created');
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
        // $user_id = $user->id;
        // $outlets = Outlet::all();
        // $outletsId = Outlet::find($id);
        // $userOutlets = DB::select('SELECT outlets_id FROM users_has_outlets WHERE users_id ='. $user_id);
        // dd($userOutlets);

        // $roles = Role::select('id', 'roles_name')->get();
        // foreach ($roles as $role) {
        //     $roleList[$role->id] = $role->roles_name;
        // }

        return view('user.edit')->with('id',$id)->with('users', $users)->with('outlets',$outlets)->with('roles', $roles)->with('users_id',$users_id);
        
        // return view('user.edit', compact('roleList'))->with('user', $user)->with('outlets',$outlets)->with('roles', $user->roles)->with('userOutlets',$userOutlets);
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

        $outlets = $request->outlet; 
        $num_outlet = count($outlets);
        for($i = 0 ; $i < $num_outlet ; $i++){
            // echo "<br>". $outlets[$i];
            $userOutlet = new UserOutlet;
            $userOutlet->users_id = $id;
            $userOutlet->outlets_id = $outlets[$i];
            $userOutlet->save();
        }

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
}
