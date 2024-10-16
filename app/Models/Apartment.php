<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use HasFactory;



    protected $fillable = ['image', 'original_name', 'slug', 'title', 'number_rooms', 'number_beds', 'number_bathrooms', 'square_meters', 'is_visible', 'address', 'lat', 'lon'];
}
