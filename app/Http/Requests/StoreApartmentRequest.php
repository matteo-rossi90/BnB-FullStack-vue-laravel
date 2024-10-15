<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreApartmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "title" => 'required|min:5|max|500',
            "image" => 'required|image',
            "original_name" => 'required|min:1|max:500',
            "number_rooms" => 'required|integer>|min:1',
            "number_beds" => 'required|integer>|min:1',
            "number_bathrooms" => 'required|integer>|min:1',
            "square_meters" => 'required|integer>|min:1',
            "address" => 'required',
            "lat" => 'required|numeric',
            "lon" => 'required|numeric',
        ];
    }

    public function messages()
{
    return [
        "title.required" => "Il titolo è obbligatorio.",
        "title.min" => "Il titolo deve contenere almeno 5 caratteri.",
        "title.max" => "Il titolo non può superare i 500 caratteri.",

        "image.required" => "L'immagine è obbligatoria.",
        "image.image" => "Il file caricato deve essere un'immagine valida.",

        "original_name.required" => "Il nome originale è obbligatorio.",
        "original_name.min" => "Il nome originale deve contenere almeno 1 carattere.",
        "original_name.max" => "Il nome originale non può superare i 500 caratteri.",

        "number_rooms.required" => "Il numero di stanze è obbligatorio.",
        "number_rooms.integer" => "Il numero di stanze deve essere un numero intero.",
        "number_rooms.min" => "Il numero di stanze deve essere almeno 1.",

        "number_beds.required" => "Il numero di letti è obbligatorio.",
        "number_beds.integer" => "Il numero di letti deve essere un numero intero.",
        "number_beds.min" => "Il numero di letti deve essere almeno 1.",

        "number_bathrooms.required" => "Il numero di bagni è obbligatorio.",
        "number_bathrooms.integer" => "Il numero di bagni deve essere un numero intero.",
        "number_bathrooms.min" => "Il numero di bagni deve essere almeno 1.",

        "square_meters.required" => "La metratura è obbligatoria.",
        "square_meters.integer" => "La metratura deve essere un numero intero.",
        "square_meters.min" => "La metratura deve essere almeno 1 metro quadrato.",

        "address.required" => "L'indirizzo è obbligatorio.",

        "lat.required" => "La latitudine è obbligatoria.",
        "lat.numeric" => "La latitudine deve essere un numero valido.",

        "lon.required" => "La longitudine è obbligatoria.",
        "lon.numeric" => "La longitudine deve essere un numero valido.",
    ];
}

}
