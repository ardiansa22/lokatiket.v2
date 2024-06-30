<?php

namespace App\Http\Controllers;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

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

        $params = array(
            'transaction_details' => array(
                'order_id' => $order->id,
                'gross_amount' => $order->total_price,
            ),
            'customer_details' => array(
                'first_name' => $order->user_id,
                'phone' => 'Auth::user()->email',
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        return view('customer.order_summary', compact('snapToken','order'));
    }

    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);
    
        if ($hashed == $request->signature_key) {
            if ($request->transaction_status == 'settlement') {
                $order = Order::find($request->order_id);
    
                // Handle payment status based on payment type
                switch ($request->payment_type) {
                    case 'credit_card':
                        // Handle credit card payment status
                        $order->update(['status' => 'Paid']);
                        break;
                    case 'bank_transfer':
                        // Handle bank transfer payment status
                        $order->update(['status' => 'Pending']); // Update status as pending, for example
                        break;
                    case 'qris':
                        // Handle QRIS payment status
                        $order->update(['status' => 'Paid']); // Assuming QRIS payments are marked as Paid upon settlement
                        break;
                    // Add cases for other payment types as needed
                    default:
                        // Handle unrecognized payment types
                        break;
                }
            }
        }
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
