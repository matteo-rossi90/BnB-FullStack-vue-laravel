<?php

namespace App\Http\Controllers\Auth\Ura;

use App\Function\Helper;
use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Http\Requests\StoreApartmentRequest;
use App\Http\Requests\UpdateApartmentRequest;
use Illuminate\Support\Facades\Storage;


class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $apartment = Apartment::where('user_id', $user->id)->get();
        return $apartment;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreApartmentRequest $request)
    {
        #il contenuto di request deve corrispondere al fillable del model
        #controllare le colonne dalla migration che mancano e le inserisci te
        #aggiungere slug
        #aggiungere id utente???$user = auth()->user(); $user->id
        #aggiungere original name

        $data = $request->all();
        $data['slug'] = Helper::generateSlug($data['title'], Apartment::class);

        if (array_key_exists('image', $data)) {

            $image_path = Storage::put('uploads', $data['image']);

            $original_name = $request->file('image')->getClientOriginalName();

            $data['image'] = $image_path;
            $data['original_name'] = $original_name;
        }

        $apartment = Apartment::create($data);
        return $apartment;
    }


    /**
     * Display the specified resource.
     */
    public function show(Apartment $apartment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Apartment $apartment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateApartmentRequest $request, Apartment $apartment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Apartment $apartment)
    {
        //
    }
}
