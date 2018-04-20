<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function dashboard(){
        $title = 'Dashboard';
        //return view('pages.index', compact('title'));
        return view('dashboard')->with('title', $title);
    }

    public function user(){
        $title = 'User';
        return view('user.user')->with('title', $title);
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