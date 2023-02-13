<?php

namespace App\Models;

use App\Models\Producteur;
use App\Models\Reservation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image_path',
        'quantity',
        'user_id',
    ];

    public function producteur(){

        return $this->belongsTo(Producteur::class);

    }

    public function reservations(){

        return $this->hasMany(Reservation::class);

    }

   
}
