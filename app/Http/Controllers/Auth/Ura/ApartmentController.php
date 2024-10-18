<?php

namespace App\Http\Controllers\Auth\Ura;

use App\Function\Helper;
use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Http\Requests\StoreApartmentRequest;
use App\Http\Requests\UpdateApartmentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $apartment = Apartment::orderBy('id', 'desc')->where('user_id', $user->id)->get();
        return $apartment;
    }

#tommy riga 26
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreApartmentRequest $request)
    {

        $data = $request->all();

        $data['slug'] = Helper::generateSlug($data['title'], Apartment::class);
        $data['user_id'] =  auth()->user()->id;

        // if (array_key_exists('image', $data) && $data['image']) {
        //     $image = Storage::put('uploads', $data['image']);
        //     $original_name = $request->file('image')->getClientOriginalName();
        //     $data['image'] = $image;
        //     $data['original_name'] = $original_name;
        // }else{
        //     $data['image'] = 'vuoto';
        //     $data['original_name'] = 'vuoto';
        // }

        if($image = $request->file('file')){
            $path = 'img/';
            $image->move($path);

        }

        $apartment = Apartment::create($data);

        // // gestione img
        // if(array_key_exists('image', $data)){
        //     $image = Storage::put('uploads', $data['image']);
        //     // $original_name= $request->file('cover_img')->getClientOriginalName();
        //     $data['image'] = $image;
        //     // $data['original_img_name'] = $original_name;
        // }



        // Se non ci sono errori, restituisci i dati codificati come JSON
        return $apartment;

    }







    #riga61
    /**
     * Display the specified resource.
     */
    // public function show(Apartment $apartment)
    public function show($id)
    {
        $apartment = Apartment::find($id);
        return response()->json($apartment);
    }

    #vincenzo riga 78
    /**
     * Show the form for editing the specified resource.
     */

    #vincenzo 92
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Apartment $apartment)
    {


        $data = $request->all();
        $oldApartament = Apartment::find($data['id']);
        $data['user_id'] =  auth()->user()->id;

        if ($data['title'] != $apartment->title) {

            $data['slug'] = Helper::generateSlug($data['title'], Apartment::class);
        }


        // if ($oldApartament->image === $data['image'] && $oldApartament->original_name !== $data['original_name'] && ) {
        //     $image = Storage::put('uploads', $data['image']);
        //     $original_name = $request->file('image')->getClientOriginalName();
        //     $data['image'] = $image;
        //     $data['original_name'] = $original_name;
        // }else{
        //     $data['image'] = 'vuoto';
        //     $data['original_name'] = 'vuoto';
        // }


        $oldApartament->update($data);

        return $apartment;
    }
















    #matte da riga 125
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($dashboard)
    {

        $apartment = Apartment::find($dashboard);
        //verifica se l'appartamento esiste e lo elimina
        if ($apartment) {
            $apartment->delete();  //elimina l'appartamento dal database
            return response()->json(['message' => 'Appartamento eliminato con successo'], 200);
        }

        return response()->json(['message' => 'Appartamento non trovato'], 404);
    }
}
