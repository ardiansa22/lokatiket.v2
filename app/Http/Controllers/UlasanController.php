<?php

namespace App\Http\Controllers;

use App\Models\Ulasan;
use App\Models\Wisata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UlasanController extends Controller
{
    public function riwayat()
    {
        $userId = Auth::id();
        $orders = Order::where('user_id', $userId)
                        ->with('wisata', 'ulasan')
                        ->get();

        return view('customer.riwayat', compact('orders'));
    }
    public function create($wisataId, $orderId)
    {
        $userId = Auth::id();

        // Cek apakah pengguna sudah pernah mengulas pembelian ini
        $existingUlasan = Ulasan::where('user_id', $userId)
                                ->where('wisata_id', $wisataId)
                                ->where('order_id', $orderId)
                                ->first();

        if ($existingUlasan) {
            return redirect()->back()->with('error', 'Anda sudah mengisi ulasan untuk pembelian ini.');
        }

        
        return view('customer.createulasan', compact('wisataId', 'orderId'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'wisata_id' => 'required|exists:wisatas,id',
            'order_id' => 'required|exists:orders,id',
            'rating' => 'required|integer|between:1,5',
            'komentar' => 'required',
        ]);

        $userId = Auth::id();

        // Cek apakah pengguna sudah pernah mengulas pembelian ini
        $existingUlasan = Ulasan::where('user_id', $userId)
                                ->where('wisata_id', $request->wisata_id)
                                ->where('order_id', $request->order_id)
                                ->first();

        if ($existingUlasan) {
            return redirect()->back()->with('error', 'Anda sudah mengisi ulasan untuk pembelian ini.');
        }

        Ulasan::create([
            'user_id' => $userId,
            'wisata_id' => $request->wisata_id,
            'order_id' => $request->order_id,
            'rating' => $request->rating,
            'komentar' => $request->komentar,
        ]);

        return redirect()->route('customer.riwayat', $request->wisata_id)
                         ->with('success', 'Ulasan berhasil ditambahkan.');
    }
}
