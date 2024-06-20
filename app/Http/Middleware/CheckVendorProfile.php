<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckVendorProfile
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   
        $user = Auth::user();

        if ($user && $user->roles->isNotEmpty() && $user->roles[0]['name'] == 'vendor') {
            $vendor = $user;
            // dd($vendor);
        }

            // Periksa apakah vendor ditemukan dan profil sudah terisi
            if ($vendor && $this->isVendorProfileComplete($vendor)) {
                // Redirect langsung ke halaman dashboard vendor
                return redirect()->route('vendor.index');
            }
        

        // Jika vendor belum mengisi profil atau bukan vendor, arahkan ke halaman pengisian biodata
        return redirect()->route('vendor.complete_profile');
    }

    /**
     * Check if vendor profile is complete.
     *
     * @param \App\Models\Vendor $vendor
     * @return bool
     */
    private function isVendorProfileComplete($vendor)
    {
        // Pastikan properti nama, phone, dan alamat tidak kosong
        return !empty($vendor->nama) && !empty($vendor->phone) && !empty($vendor->alamat);
    }
}
