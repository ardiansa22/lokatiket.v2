<?php

namespace App\Http\Controllers;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $profiles = Profile::all();
        return view('customer.profil', compact('profiles'));
    }

    // public function create()
    // {
    //     return view('profiles.create');
    // }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'no_telepon' => 'required|string|max:15',
            'alamat' => 'required|string|max:255',
        ]);

        Profile::create($request->all());

        return redirect()->route('profiles.index')->with('success', 'Profile created successfully.');
    }

    public function show(Profile $profile)
    {
        return view('profiles.show', compact('profile'));
    }

    public function edit(Profile $profile)
    {
        return view('profiles.edit', compact('profile'));
    }

    public function update(Request $request, Profile $profile)
    {
        $request->validate([
            'no_telepon' => 'required|string|max:15',
            'alamat' => 'required|string|max:255',
        ]);

        $profile->update($request->all());

        return redirect()->route('profiles.index')->with('success', 'Profile updated successfully.');
    }

    public function destroy(Profile $profile)
    {
        $profile->delete();

        return redirect()->route('profiles.index')->with('success', 'Profile deleted successfully.');
    }
}
