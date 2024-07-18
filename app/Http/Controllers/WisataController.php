<?php

namespace App\Http\Controllers;

use App\Models\Wisata;
use Symfony\Component\HttpFoundation\Request;
use App\Http\Requests\UpdateWisataRequest;
use Illuminate\Support\Facades\Auth;

class WisataController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:vendor-any', ['any']);
    }
    
    public function create()
    {
        return view('vendor.produk.create');
    }
    public function index()
    {
       
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'description' => 'required',
        'price' => 'required|numeric',
        'images' => 'required',
        'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'kategori' => 'required',
        'facilities' => 'required',
    ]);
    $userId = Auth::id();
    $wisata = new Wisata();
    $wisata->user_id = $userId;
    $wisata->name = $request->name;
    $wisata->description = $request->description;
    $wisata->price = $request->price;
    $wisata->kategori = $request->kategori;
    $wisata->facilities = $request->facilities;

    if($request->hasfile('images')) {
        $images = [];
        foreach($request->file('images') as $image) {
            $name = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/images', $name);
            $images[] = $name;
        }
        $wisata->images = json_encode($images);
    }

    $wisata->save();

    return back()->with('success', 'Wisata berhasil ditambahkan.');
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Wisata  $wisata
     * @return \Illuminate\Http\Response
     */
    public function show(Wisata $wisata)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Wisata  $wisata
     * @return \Illuminate\Http\Response
     */
    public function edit(Wisata $wisata)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateWisataRequest  $request
     * @param  \App\Models\Wisata  $wisata
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWisataRequest $request, Wisata $wisata)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Wisata  $wisata
     * @return \Illuminate\Http\Response
     */
    public function destroy(Wisata $wisata)
    {
        //
    }
}
