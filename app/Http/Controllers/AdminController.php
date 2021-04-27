<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function dashboard(){
        return view('admin.dashboard');
    }

    public function show(){
       
        return view('admin.products');
    }
}

