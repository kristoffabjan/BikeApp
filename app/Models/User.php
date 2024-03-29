<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function bikes(){
        return $this->hasMany(Bike::class);
    }


    public function rates(){
        return $this->hasMany(BikeRates::class);
    }

    public function shops(){
        return $this->hasMany(Shop::class);
    }

    public function shop_rates()
    {
        return $this->hasMany(ShopRates::class);
    }

    public function tests()
    {
        return $this->hasMany(Test::class);
    }
}
