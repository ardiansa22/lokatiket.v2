<?php
    
namespace App\Http\Controllers;
    
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Symfony\Component\HttpFoundation\StreamedResponse;
use League\Csv\Writer;
use App\Models\Wisata;
use App\Models\Order;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
    
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = User::all();
        // information bar
        $totalUsers = User::count();
        $totalOrder =  Order::where('status', 'paid')->count();
        $totalOrderPaid =  Order::where('status', 'paid')->sum('total_price');
        $totalWisata = Wisata::count();
        $vendorCount = User::role('vendor')->count();
        $customerCount = User::role('customer')->count();
        $adminCount = User::role('superadmin')->count();

        // informasi daftar wisata 
        $wisata = Wisata::all();
        // informasi transaksi
        $order = Order::all();
        return view('superadmin.users.index',compact('data','totalUsers', 'vendorCount','customerCount','adminCount','totalWisata','totalOrder','totalOrderPaid','wisata','order'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
   
    public function filterOrders(Request $request)
    {
        // Ambil input dari request
        $month = $request->input('month');
        $year = $request->input('year');
        $vendorId = $request->input('vendor_id');

        // Ambil vendor berdasarkan role
        $vendors = User::role('vendor')->get();

        // Query untuk memfilter order
        $ordersQuery = Order::whereHas('wisata', function ($query) use ($vendorId) {
            if ($vendorId) {
                $query->whereHas('user', function ($q) use ($vendorId) {
                    $q->where('id', $vendorId);
                });
            }
        })
        ->whereYear('created_at', $year)
        ->whereMonth('created_at', $month)
        ->where('status', 'paid');

        // Ambil hasil query
        $orders = $ordersQuery->get();
        
        // Hitung total order dan total harga
        $totalOrders = $ordersQuery->count();
        $totalPrice = $ordersQuery->sum('total_price');
        
        return view('superadmin.report.report', compact('orders', 'vendors', 'totalOrders', 'totalPrice'));
    }

    public function exportCsv(Request $request)
    {
        $month = $request->input('month');
        $year = $request->input('year');
        $vendorId = $request->input('vendor_id');
    
        $ordersQuery = Order::whereHas('wisata', function ($query) use ($vendorId) {
            if ($vendorId) {
                $query->whereHas('user', function ($q) use ($vendorId) {
                    $q->where('id', $vendorId);
                });
            }
        })
        ->whereYear('created_at', $year)
        ->whereMonth('created_at', $month)
        ->where('status', 'paid');
    
        $orders = $ordersQuery->get();
        $totalPrice = $orders->sum('total_price');
    
        // Set up CSV headers
        $headers = [
            'ID',
            'Jumlah',
            'Harga Total',
            'Tanggal Pesanan',
            'Nama Vendor',
            'Nama Wisata',
        ];
    
        // Create a CSV writer instance
        $csv = Writer::createFromFileObject(new \SplTempFileObject());
    
        // Insert headers into CSV
        $csv->insertOne($headers);
    
        // Insert data rows into CSV
        foreach ($orders as $index => $order) {
            // Ensure visit_date and created_at are not null before formatting

            $createdAt = $order->created_at ? $order->created_at->format('Y-m-d H:i:s') : 'N/A';
    
            $csv->insertOne([
                $order->id,
                $order->quantity ?? 'N/A',
                $order->total_price ?? 'N/A', // Format harga total dengan ribuan separator
      
                $createdAt,
                $order->wisata->user->name ?? 'N/A', // Vendor name
                $order->wisata->name ?? 'N/A', // Wisata name
            ]);
        }
    
        // Add total price row at the end of the CSV
        $csv->insertOne([
            '', '', '', '', 'Total Harga ', $totalPrice
        ]);
    
        // Create a StreamedResponse to output the CSV
        $response = new StreamedResponse(function () use ($csv) {
            $csv->output();
        });
    
        // Set response headers for CSV download
        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="orders_report.csv"');
    
        return $response;
    }

    

    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('superadmin.users.create',compact('roles'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);
    
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
    
        $user = User::create($input);
        $user->assignRole($request->input('roles'));
    
        return redirect()->route('superadmin.users.index')
                        ->with('success','User created successfully');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('superadmin.users.show',compact('user'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
    
        return view('superadmin.users.edit',compact('user','roles','userRole'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);
    
        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }
    
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
    
        $user->assignRole($request->input('roles'));
    
        return redirect()->route('superadmin.users.index')
                        ->with('success','User updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('superadmin.users.index')
                        ->with('success','User deleted successfully');
    }
}