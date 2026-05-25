<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Midtrans\Config;
use Midtrans\Snap;

class PaymentController extends Controller
{
    public function payment()
    {
        // CONFIG MIDTRANS
        Config::$serverKey = config('midtrans.server_key');

        Config::$isProduction = config('midtrans.is_production');

        Config::$isSanitized = true;

        Config::$is3ds = true;

        // DATA TRANSAKSI
        $params = [

            'transaction_details' => [

                'order_id' => 'ORDER-' . rand(),

                'gross_amount' => 230000,

            ],

            'customer_details' => [

                'first_name' => 'Ayla',

                'email' => 'ayla@gmail.com',

            ]

        ];

        // GENERATE SNAP TOKEN
        $snapToken = Snap::getSnapToken($params);

        return response()->json([

            'snap_token' => $snapToken

        ]);
    }
}