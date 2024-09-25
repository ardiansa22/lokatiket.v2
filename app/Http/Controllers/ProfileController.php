<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; 

class ProfileController extends Controller
{
    public function editImage(Request $request)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5048',
        ]);

        $user = Auth::user();

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($user->profile && $user->profile->image) {
                Storage::delete('public/' . $user->profile->image);
            }

            // Simpan gambar baru
            $path = $request->file('image')->store('profile_images', 'public');

            // Update profil user
            $user->profile()->updateOrCreate([], ['image' => $path]);
        }

        return redirect()->back()->with('success', 'Profile image updated successfully.');
    }

    public function removeImage()
    {
        $user = Auth::user();

        // Hapus gambar jika ada
        if ($user->profile && $user->profile->image) {
            Storage::delete('public/' . $user->profile->image);
            $user->profile->update(['image' => null]);
        }

        return redirect()->back()->with('success', 'Profile image removed successfully.');
    }
   
}
