<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\UserOutlet;
use App\Models\Outlet;
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
        // $users = User::all();

        $users = User::orderBy('created_at','desc')->paginate(10);
<<<<<<< HEAD
=======
        $outlet = Outlet::all();
>>>>>>> 7555232f213ee7fe1f7080d1f113282673cb3e64
        return view('user.user')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $outlets = Outlet::all();
        return view('auth.staffsignup')->with('outlets',$outlets);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        // Create Internal User
        $role = (int)$request->input('role');
        $user = new User;
        $user->roles_id = $role;
        $user->name = $request->input('username');
        $user->email = $request->input('email');
        $user->phone_number = $request->input('phone_number');
        $user->password = $request->input('password');
        $user->save();

        $outlets = $request->outlet; 
        $num_outlet = count($outlets);
        for($i = 0 ; $i < $num_outlet ; $i++){
            // echo "<br>". $outlets[$i];
            $userOutlet = new UserOutlet;
            $userOutlet->users_id = $user->id;
            $userOutlet->outlets_id = $outlets[$i];
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
        $user = User::find($id);
        return view('user.edit')->with('user', $user);
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
        $user = User::find($id);
        $user->username = $request->input('username');
        $user->save();

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
        $user = User::find($id);
        $user->delete();
        return redirect('/user')->with('success', 'Post Removed');
    }
}
