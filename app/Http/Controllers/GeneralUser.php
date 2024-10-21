<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\Service;
use Illuminate\Http\Request;


class GeneralUser extends Controller
{
    public function allApartment(){

        $allApartment = Apartment::with('services')->get();


        return response()->json($allApartment);;

    }

    public function services(){
        return response()->json(Service::all());
    }

}
