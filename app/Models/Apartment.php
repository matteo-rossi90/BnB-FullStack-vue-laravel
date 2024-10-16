<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use HasFactory;



    protected $fillable =
    ['image', 'title', 'number_rooms', 'number_beds', 'number_bathrooms', 'square_meters', 'address'];
}
