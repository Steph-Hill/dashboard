<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Commercant;
use App\Models\Producteur;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservation extends Model
{
    use HasFactory;

    public function producteur(){

        return $this->belongsTo(Producteur::class);

    }

    public function commercant(){

        return $this->belongsTo(Commercant::class);

    }

    public function product(){

        return $this->belongsTo(Product::class);

    }
}
