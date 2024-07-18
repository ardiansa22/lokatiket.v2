<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Models\Order;
use App\Models\wisata;
use App\Http\Requests\StoreVendorRequest;
use App\Http\Requests\UpdateVendorRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:vendor-any', ['any']);
    }
    public function index()
    {
        $userId = Auth::id();
        
        // Ambil semua wisata yang dikelola oleh pengelola yang sedang login
        $all = Wisata::where('user_id', $userId)->pluck('id');
        // Ambil semua pesanan yang terkait dengan wisata yang dikelola oleh pengelola
        $orders = Order::whereIn('wisata_id', $all)->get(); 
        $totalPrice = $orders->sum('total_price');
        $totalOrder = $orders->count('id');
        $paidOrders = $orders->where('status', 'paid');
        $wisatas = Wisata::where('user_id', $userId)->get();
        return view('vendor.home',compact('wisatas','orders','totalPrice','totalOrder','paidOrders'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
        // return view('vendor.home');
    }
    public function pesanan()
    {
        $userId = Auth::id();
        
        // Ambil semua wisata yang dikelola oleh pengelola yang sedang login
        $all = Wisata::where('user_id', $userId)->pluck('id');
        // Ambil semua pesanan yang terkait dengan wisata yang dikelola oleh pengelola
        $orders = Order::whereIn('wisata_id', $all)->get();
        $paidOrders = $orders->where('status', 'paid');
        $wisatas = Wisata::where('user_id', $userId)->get();
        return view('vendor.pesanan.index',compact('wisatas','orders','paidOrders'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
        // return view('vendor.home');
    }
    public function produk()
    {
        $userId = Auth::id();
        
        $wisatas = Wisata::where('user_id', $userId)->get();
        return view('vendor.produk.index',compact('wisatas'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
        // return view('vendor.home');
    }


    public function wisata()
    {
        return view('vendor.produk.index');
    }

    

    
   
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreVendorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVendorRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function show(Vendor $vendor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function edit(Vendor $vendor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVendorRequest  $request
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVendorRequest $request, Vendor $vendor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vendor $vendor)
    {
        //
    }
}
