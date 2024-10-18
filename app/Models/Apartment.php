<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Apartment extends Model
{
    use HasFactory;
    use SoftDeletes;



    protected $fillable =
    [
        'title',
        'user_id',
        'slug',
        'image',
        'original_name',
        'number_rooms',
        'number_beds',
        'number_bathrooms',
        'square_meters',
        'address',
        'lat',
        'lon'
    ];
}
