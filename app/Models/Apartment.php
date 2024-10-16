<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use HasFactory;



    protected $fillable =
    ['image', 'user_id', 'title', 'original_name', 'number_rooms', 'slug', 'number_beds', 'number_bathrooms', 'square_meters', 'address', 'is_visible', 'lat', 'lon'];
}
