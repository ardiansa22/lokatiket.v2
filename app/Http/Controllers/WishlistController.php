<?php

namespace App\Http\Controllers;

use App\Models\Wisata;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlist = auth()->user()->wishlist;
        return view('wishlist.index', compact('wishlist'));
    }

    public function store($wisataId)
    {
        $wisata = Wisata::findOrFail($wisataId);
        auth()->user()->wishlist()->syncWithoutDetaching([$wisata->id]);

        return back()->with('success', 'Wisata berhasil ditambahkan ke wishlist.');
    }

    public function destroy($wisataId)
    {
        auth()->user()->wishlist()->detach($wisataId);

        return back()->with('success', 'Wisata berhasil dihapus dari wishlist.');
    }
}
