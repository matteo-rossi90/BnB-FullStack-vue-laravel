<?php

namespace App\Http\Controllers\Auth\Ura;

use App\Http\Controllers\Controller;
use App\Http\Requests\Orders\OrderRequest;
use App\Models\Sponsor;
use Braintree\Gateway;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function generate(Request $request, Gateway $gateway){
        // dd($request');
        $token = $gateway->clientToken()->generate();
        $data = [
            'token' => $token
        ];

        return response()->json($data, 200);
    }
    public function makePayment(OrderRequest $request, Gateway $gateway){

        $sponsor = Sponsor::find($request->sponsor);
        $result = $gateway->transaction()->sale([
            'amount' => $sponsor->price,
            'paymentMethodNonce' => $request->token,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        if($result->success){
            $data = [
                'success' => true,
                'message' => 'Transazione eseguita con successo'
            ];
            return response()->json($data, 200);

        }else{
            $data = [
                'success' => false,
                'message' => 'Transazione Fallita!!!'
            ];
            return response()->json($data, 401);
        }
    }

}
