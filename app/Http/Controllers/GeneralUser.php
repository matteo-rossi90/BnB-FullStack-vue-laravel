<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use Illuminate\Http\Request;

class GeneralUser extends Controller
{
    public function allApartment(){
        $allApartment = Apartment::all();

        return $allApartment;

    }
}
