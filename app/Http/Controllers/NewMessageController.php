<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;


class NewMessageController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->all();
        $success = true;

        $new_message = new Message();
        $new_message->fill($data);
        $new_message->save();

        return response()->json(compact('success'));
    }
}
