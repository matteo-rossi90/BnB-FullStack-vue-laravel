<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}

//"title" => "dfasdf"
        //   "address" => "fdasd"
        //   "lat" => null
        //   "lon" => null
        //   "number_rooms" => 1
        //   "number_beds" => 1
        //   "number_bathrooms" => 1
        //   "image" => null
        //   "square_meters" => 1
