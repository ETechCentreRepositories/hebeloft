<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home(){
        $title = 'Dashboard';
        return view('home')->with('title', $title);
    }

    public function inventory(){
        $title = 'Inventory';
        return view('inventory.index')->with('title', $title);
    }

    public function salesorder(){
        $title = 'Sales Order';
        return view('salesorder.index')->with('title', $title);
    }

    public function transferrequest(){
        $title = 'Transfer Request';
        return view('transferrequest.index')->with('title', $title);
    }

    public function salesrecord(){
        $title = 'Sales Record';
        return view('salesrecord.index')->with('title', $title);
    }

    public function user(){
        $title = 'User';
        return view('user.index')->with('title', $title);
    }

    public function outlet(){
        $title = 'Outlet';
        return view('outlets.index')->with('title', $title);
    }

    public function product(){
        $title = 'Product';
        return view('product.index')->with('title', $title);
    }
}