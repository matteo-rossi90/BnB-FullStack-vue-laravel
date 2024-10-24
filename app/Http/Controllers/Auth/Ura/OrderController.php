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


}
