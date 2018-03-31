<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    // Middleware for Admin
    public function __construct()
	{
	    $this->middleware('auth:admin');
    }
    
    public function index()
    {
    	return view('admin.home');
    }
}
