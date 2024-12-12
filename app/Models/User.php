<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Country;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    
    protected $fillable = [
        'names',
        'lastnames',
        'email',
        'password',
        'gender',
        'address',
        'phone',
        'country_id'
    ];

    public function country(){
        return $this->belongsTo(Country::class);
    }
}
