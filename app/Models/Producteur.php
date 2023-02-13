<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Reservation;
use Illuminate\Database\Eloquent\Model;
use App\Notifications\RestPasswordNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Producteur extends Model
{
    
    use HasFactory, HasApiTokens, Notifiable;


    protected $fillable = [

        'producteur_name',
        'email',
        'entreprise',
        'password'
        
    ];

    public function products(){

        return $this->hasMany(Product::class);

    }

    public function reservations(){

        return $this->hasMany(Reservation::class);
        
    }


     /* Creation de mon url pour reset password */
     public function sendPasswordResetNotification($token)
     {
 
         $url = 'https://localhost/reset-password?token=' . $token;
 
         $this->notify(new RestPasswordNotification($url));
     }
}
