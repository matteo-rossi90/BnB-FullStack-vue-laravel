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


    #tommy riga 34
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreApartmentRequest $request)
    {
        dd($request->all());

        $data = $request->all();
        $data['slug'] = Helper::generateSlug($data['title'], Apartment::class);
        $data['user_id'] =  auth()->user()->id;
        if (array_key_exists('image', $data)) {
            $image = Storage::put('uploads', $data['image']);
            $original_name = $request->file('image')->getClientOriginalName();
            $data['image'] = $image;
            $data['original_name'] = $original_name;
        }
        $apartment = Apartment::create($data);
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
    public function update(UpdateApartmentRequest $request, Apartment $apartment)
    {
        $data = $request->all();
        if ($data['title'] != $apartment->title) {

            $data['slug'] = Helper::generateSlug($data['title'], Apartment::class);
        }
        $apartment->update($data);
        return $apartment;
    }
















    #matte da riga 125
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Apartment $apartment)
    {
        //
    }
}
