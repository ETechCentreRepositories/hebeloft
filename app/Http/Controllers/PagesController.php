<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home(){
        $title = 'Welcome To Laravel!';
        //return view('pages.index', compact('title'));
        return view('home')->with('title', $title);
    }

    public function user(){
        $title = 'User';
        return view('user')->with('title', $title);
    }

    // public function staffsignup(){
    //     $title = 'Staff Sign Up';
    //     return view('auth.staffsignup')->with('title', $title);
    // }

    public function outlet(){
        $title = 'Outlet';
        return view('outlet')->with('title', $title);
    }
}