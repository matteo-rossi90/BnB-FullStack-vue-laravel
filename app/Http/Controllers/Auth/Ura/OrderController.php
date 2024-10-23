<?php

namespace App\Http\Controllers\Auth\Ura;

use App\Http\Controllers\Controller;
use App\Http\Requests\Orders\OrderRequest;
use Braintree\Gateway;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function generate(Request $request, Gateway $gateway){
        $token = $gateway->clientToken()->generate();
        $data = [
            'token' => $token
        ];

        return response()->json($data, 200);
    }
    public function makePayment(OrderRequest $request, Gateway $gateway){

        $result = $gateway->transaction()->sale([
            'amount' => $request->amount,
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