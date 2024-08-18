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
        'fasilitas_lainnya' => 'array',
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

public function updat(Request $request, $id)
{
    $request->validate([
        'name' => 'required',
        'description' => 'required',
        'price' => 'required|numeric',
        'images' => 'required',
        'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'kategori' => 'required',
        'fasilitas' => 'required|array',
        'fasilitas_lainnya' => 'array',
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
    // dd($wista);
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

public function update(Request $request, $id)
{
    // Validasi data input
    $request->validate([
        
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'facilities' => 'nullable|array',
            'facilities.*' => 'string|max:255',
            'fasilitas_lainnya' => 'nullable|array',
            'fasilitas_lainnya.*' => 'nullable|string|max:255', // Ubah dari array menjadi string
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'kategori' => 'required'
    ]);

    // Cek data request
    // dd($request->all()); // Dump semua data dari request

    $wisata = Wisata::findOrFail($id);

    // Dump data wisata sebelum di-update
    // dd($wisata);

    // Update data wisata
    $wisata->name = $request->input('name');
    $wisata->description = $request->input('description');
    $wisata->price = $request->input('price');
    
    // Gabungkan fasilitas yang di-input dengan fasilitas lainnya
    $facilities = $request->input('facilities', []);
    $additionalFacilities = $request->input('fasilitas_lainnya', []);
    $wisata->facilities = json_encode(array_merge($facilities, $additionalFacilities));

    // Dump fasilitas yang sudah digabungkan
    // dd($wisata->facilities);

    $wisata->kategori = $request->input('kategori');

    // Handle upload images jika ada file baru yang di-upload
    if ($request->hasFile('images')) {
        // Hapus gambar lama jika ada
        if ($wisata->images) {
            $oldImages = json_decode($wisata->images);
            // dd($oldImages); // Dump gambar lama sebelum dihapus
            foreach ($oldImages as $oldImage) {
                Storage::delete('public/images/' . $oldImage);
            }
        }

        $images = [];
        foreach ($request->file('images') as $image) {
            $path = $image->store('public/images');
            $filename = basename($path);
            $images[] = $filename;
        }
        $wisata->images = json_encode($images);

        // Dump gambar baru yang di-upload
        // dd($wisata->images);
    }

    $wisata->save();

    // Dump data wisata setelah disimpan
    // dd($wisata);

    // Redirect kembali ke halaman list wisata dengan pesan sukses
    return back()->with('success', 'Wisata berhasil diubah.');
    
}
}