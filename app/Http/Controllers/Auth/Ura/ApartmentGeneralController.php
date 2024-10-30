<?php

namespace App\Http\Controllers\Auth\Ura;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApartmentGeneralController extends Controller
{
    public function update(Request $request){
        // dd(json_decode($request->input('apartment'), true));
        dd($request->file('image'));
    }
}
