<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BikesAtShop extends Model
{
    use HasFactory;

    protected $fillable = [
        'shop_id',
        'bike_id'
    ];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function bike()
    {
        return $this->belongsTo(Bike::class);
    }

    
}
