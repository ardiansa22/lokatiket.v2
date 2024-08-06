<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Wisata;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class CustomerController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:customer-any', ['any']);
    }
    public function index()
    {   $wisatas = Wisata::all();
        return view('customer.index', compact('wisatas'));
       
    }
    public function search(Request $request)
    {
        $query = $request->input('query');
        $results = Wisata::where('name', 'LIKE', "%{$query}%")->get();
        return response()->json($results);
    }
    public function tampilkan(Wisata $wisata)
    {
        return view('customer.show', compact('wisata'));
    }
    public function explore()
    {
       $wisatas = Wisata::with('ulasans')->get();
        return view('customer.explore', compact('wisatas'));
    }
    public function filterByCategory($kategori)
    {
        $wisatas = Wisata::where('kategori', $kategori)->get();
        return view('customer.explore', compact('wisatas'));
    }
    public function summary(Request $request)
    {
        $wisata = Wisata::find($request->wisata_id);
        $quantity = $request->quantity;
        return view('customer.order_summary', compact('wisata', 'quantity'));
    }
    public function profil()
    {
        
        return view('customer.profile');
    }
    public function updateprofil(Request $request, $id)
{
    $this->validate($request, [
        'name' => 'required',
    ]);

    $user = User::find($id);
    $user->update(['name' => $request->input('name')]);

    return redirect()->route('customer.profile')
                    ->with('success', 'User updated successfully');
}


    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current-password' => 'required',
            'password' => 'required|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = Auth::user();

        if (!Hash::check($request->get('current-password'), $user->password)) {
            return redirect()->back()->withErrors(['current-password' => 'Password lama tidak cocok'])->withInput();
        }

        $user->password = Hash::make($request->get('password'));
        $user->save();

        return redirect()->route('customer.profile')->with('success', 'Password berhasil diubah');
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCustomerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomerRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCustomerRequest  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
