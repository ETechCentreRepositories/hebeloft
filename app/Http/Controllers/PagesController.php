<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home(){
        $title = 'Dashboard';
        return view('home')->with('title', $title);
    }

    public function salesorder(){
        $title = 'Sales Order';
        return view('salesorder.index')->with('title', $title);
    }

    public function user(){
        $title = 'User';
        return view('user.index')->with('title', $title);
    }

    // public function staffsignup(){
    //     $title = 'Staff Sign Up';
    //     return view('auth.staffsignup')->with('title', $title);
    // }

    public function outlet(){
        $title = 'Outlet';
        return view('outlets.index')->with('title', $title);
    }
}