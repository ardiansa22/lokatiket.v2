<?php

namespace App\Http\Controllers;

use App\Models\Wisata;
use Symfony\Component\HttpFoundation\Request;
use App\Http\Requests\UpdateWisataRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


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
        'fasilitas' => 'required|array',
        'fasilitas_lainnya' => 'array'
    ]);

    $userId = Auth::id();
    $wisata = new Wisata();
    $wisata->user_id = $userId;
    $wisata->name = $request->name;
    $wisata->description = $request->description;
    $wisata->price = $request->price;
    $wisata->kategori = $request->kategori;

    // Menggabungkan fasilitas checkbox dengan fasilitas lainnya
    $fasilitas = $request->fasilitas;
    if ($request->has('fasilitas_lainnya')) {
        $fasilitas = array_merge($fasilitas, array_filter($request->fasilitas_lainnya));
    }
    $wisata->facilities = json_encode($fasilitas);

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
    public function edit($id)
{
    $wisata = Wisata::findOrFail($id);

    // Pastikan hanya pemilik wisata yang dapat mengedit
    if ($wisata->user_id !== Auth::id()) {
        return redirect()->route('vendor.produk')->with('error', 'Anda tidak memiliki akses untuk mengedit wisata ini.');
    }

    return view('vendor.produk.index', compact('wisata'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required',
        'description' => 'required',
        'price' => 'required|numeric',
       
        'facilities' => 'required',
    ]);

    $wisata = Wisata::findOrFail($id);

    // Pastikan hanya pemilik wisata yang dapat mengupdate
    if ($wisata->user_id !== Auth::id()) {
        return redirect()->route('vendor.produk')->with('error', 'Anda tidak memiliki akses untuk mengupdate wisata ini.');
    }

    $wisata->name = $request->name;
    $wisata->description = $request->description;
    $wisata->price = $request->price;

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

    return back()->with('success', 'Wisata berhasil diubah.');
}
public function destroy($id)
{
    $wisata = Wisata::findOrFail($id);

    // Pastikan hanya pemilik wisata yang dapat menghapus
    if ($wisata->user_id !== Auth::id()) {
        return redirect()->route('vendor.produk')->with('error', 'Anda tidak memiliki akses untuk menghapus wisata ini.');
    }

    // Hapus gambar dari storage
    $images = json_decode($wisata->images);
    if ($images) {
        foreach ($images as $image) {
            Storage::delete('public/images/' . $image);
        }
    }

    $wisata->delete();

    return redirect()->route('vendor.produk')->with('success', 'Wisata berhasil dihapus.');
}
    
}
