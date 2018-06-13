<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Models\Wholesaler;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Input;
use App\Models\AuditTrail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/inventory';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone_number' => 'required',
            'billing_address' => 'required',
            'shipping_address' => 'required',
            'password' => 'required|string|min:6|confirmed'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $auditTrail = AuditTrail::create([
            'action' => 'Wholesaler Created',
            'action_by' => $data['name']
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone_number'=>$data['phone_number'],
            'roles_id'=> (int) $data['roles_id'],
            'password' => Hash::make($data['password']),
            'audit_trails_id' => $auditTrail->id,
        ]);
        
        $wholesaler =  Wholesaler::create([
            'users_id'=> $user->id,
            'billing_address'=>$data['billing_address'],
            'shipping_address'=>$data['shipping_address'],
            'company_name'=>$data['company_name']
        ]);
        
        return $user;
        
    }
}
