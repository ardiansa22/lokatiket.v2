<?php

namespace App\Http\Controllers;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    
    public function index()
    {
        
    }


    public function checkout(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'wisata_id' => 'required',
            'quantity' => 'required|numeric',
            'visit_date' => 'required',
            'total_price' => 'required',
        ]);
        $request->request->add(['status' => 'unpaid']);
        $order = Order::create($request->all());

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
        $prefix = 'ORD-'; // Definisikan prefix yang Anda inginkan
$midtrans_order_id = $prefix . $order->id;

        $params = array(
            'transaction_details' => array(
                'order_id' => $midtrans_order_id,
                'gross_amount' => $order->total_price,
            ),
            'customer_details' => array(
                'first_name' => $order->user->name,
                'email' => Auth::user()->email,
            ),
            'item_details' => array(
                array(
                    'id' => $order->wisata_id,
                    'name' => $order->wisata->name,
                    'quantity' => $order->quantity,
                    'price' => $order->wisata->price,
                )
            ),
        );
        

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        return view('customer.order_summary', compact('snapToken','order'));
    }

    // public function callback(Request $request)
    // {
    //     $serverKey = config('midtrans.server_key');
    //     $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);
    
    //     if ($hashed == $request->signature_key) {
    //         if ($request->transaction_status == 'settlement' | $request->transaction_status == 'capture') {
    //             $order = Order::find($request->order_id);
    
    //             // Handle payment status based on payment type
    //             switch ($request->payment_type) {
    //                 case 'credit_card':
    //                     // Handle credit card payment status
    //                     $order->update(['status' => 'Paid']);
    //                     break;
    //                 case 'bank_transfer':
    //                     // Handle bank transfer payment status
    //                     $order->update(['status' => 'Paid']); // Update status as pending, for example
    //                     break;
    //                 case 'qris':
    //                     // Handle QRIS payment status
    //                     $order->update(['status' => 'Paid']); // Assuming QRIS payments are marked as Paid upon settlement
    //                     break;
    //                 // Add cases for other payment types as needed
    //                 default:
    //                     // Handle unrecognized payment types
    //                     break;
    //             }
    //         }
    //     }
    // }
//     public function callback(Request $request)
// {
//     Log::info("MIDTRANS CALLBACK", $request->all());

//     $serverKey = config('midtrans.server_key');

//     // Validasi signature sesuai Midtrans
//     $expectedSignature = hash(
//         'sha512',
//         $request->order_id .
//         $request->status_code .
//         $request->gross_amount .   // string format "15000.00"
//         $serverKey
//     );

//     if ($expectedSignature !== $request->signature_key) {
//         Log::error("MIDTRANS INVALID SIGNATURE");
//         return response()->json(['message' => 'Invalid signature'], 403);
//     }

//     // Ambil angka ID dari ORD-208
//     $orderId = str_replace('ORD-', '', $request->order_id);
//     $order = Order::find($orderId);

//     if (!$order) {
//         Log::error("ORDER NOT FOUND", ['order_id' => $orderId]);
//         return response()->json(['message' => 'Order not found'], 404);
//     }

//     // Status berhasil
//     if ($request->transaction_status === 'capture' || $request->transaction_status === 'settlement') {
//         $order->update([
//             'status' => 'paid'
//         ]);

//         Log::info("ORDER UPDATED TO PAID", ['order_id' => $orderId]);
//     }

//     return response()->json(['message' => 'success'], 200);
// }
public function callback(Request $request)
{
    // RAW JSON langsung dari Midtrans
    $rawJson = $request->getContent();
    $raw = json_decode($rawJson, true);

    Log::info("MIDTRANS RAW CALLBACK", ['raw' => $rawJson]);
    Log::info("MIDTRANS PARSED CALLBACK", $raw);

    $serverKey = config('midtrans.server_key');

    // Hitung signature berdasarkan RAW data, bukan parsed data
    $expectedSignature = hash(
        'sha512',
        $raw['order_id'] .
        $raw['status_code'] .
        $raw['gross_amount'] .
        $serverKey
    );

    if ($expectedSignature !== $raw['signature_key']) {
        Log::error("MIDTRANS INVALID SIGNATURE", [
            'expected' => $expectedSignature,
            'received' => $raw['signature_key']
        ]);
        return response()->json(['message' => 'Invalid signature'], 403);
    }

    // Ambil angka ID dari ORD-xxx
    $orderId = str_replace('ORD-', '', $raw['order_id']);
    $order = Order::find($orderId);

    if (!$order) {
        Log::error("ORDER NOT FOUND", ['order_id' => $orderId]);
        return response()->json(['message' => 'Order not found'], 404);
    }

    // Update status jika payment sukses
    if ($raw['transaction_status'] === 'capture' ||
        $raw['transaction_status'] === 'settlement') {

        $order->update([
            'status' => 'paid'
        ]);

        Log::info("ORDER UPDATED TO PAID", ['order_id' => $orderId]);
    }

    return response()->json(['message' => 'success'], 200);
}


    public function history()
    {
        $order = Order::where('user_id', Auth::id())
                    ->where('status', 'paid')
                    ->get();
        return view('customer.history', compact('order'));
    }

    public function invoice($id)
    {
        $order = Order::find($id);
        return view('customer.order_detail',compact('order'));
    }
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
