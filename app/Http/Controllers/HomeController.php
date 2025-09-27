<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        // dd($user->roles[0]['name']);
        if($user->roles[0]['name'] == 'superadmin') {
            return redirect()->route('superadmin.users.index');
        }elseif($user->roles[0]['name'] == 'vendor'){
            return redirect()->route('vendor.index');
        }elseif($user->roles[0]['name'] == 'customer'){
            return redirect()->route('menu');
        }
        return view('home');
    }
}
