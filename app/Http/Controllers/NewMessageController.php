<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Apartment;


class NewMessageController extends Controller
{
    public function store(Request $request, $apartment_id)
    {
        $apartment = Apartment::find($apartment_id);
        $data = $request->all();

        $new_message = new Message();
        $new_message->fill($data);
        $new_message->apartment_id = $apartment->id;
        $new_message->save();

        $success = true;

        return response()->json(compact('success'));
    }
}
