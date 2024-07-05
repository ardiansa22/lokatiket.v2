<?php

namespace App\Http\Controllers;

use App\Models\Ulasan;
use App\Models\Wisata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UlasanController extends Controller
{
    /**
     * Menampilkan form untuk membuat ulasan baru.
     *
     * @param int $wisataId
     * @return \Illuminate\View\View
     */
    public function create($wisataId)
    {
        $userId = Auth::id();

        // Cek apakah pengguna sudah pernah mengulas wisata ini
        $existingUlasan = Ulasan::where('user_id', $userId)
                                ->where('wisata_id', $wisataId)
                                ->first();

        if ($existingUlasan) {
            return redirect()->back()->with('error', 'Anda sudah mengisi ulasan untuk wisata ini.');
        }

        return view('customer.createulasan', compact('wisataId'));
    }

    /**
     * Menyimpan ulasan baru ke database.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'wisata_id' => 'required|exists:wisatas,id',
            'rating' => 'required|integer|between:1,5',
            // 'komentar' => 'required|string|max:1000',
        ]);

        $userId = Auth::id();

        // Cek apakah pengguna sudah pernah mengulas wisata ini
        $existingUlasan = Ulasan::where('user_id', $userId)
                                ->where('wisata_id', $request->wisata_id)
                                ->first();

        if ($existingUlasan) {
            return redirect()->back()->with('error', 'Anda sudah mengisi ulasan untuk wisata ini.');
        }

        Ulasan::create([
            'user_id' => $userId,
            'wisata_id' => $request->wisata_id,
            'rating' => $request->rating,
            // 'komentar' => $request->komentar,
        ]);

        return redirect()->route('customer.riwayat', $request->wisata_id)
                         ->with('success', 'Ulasan berhasil ditambahkan.');
    }
}
