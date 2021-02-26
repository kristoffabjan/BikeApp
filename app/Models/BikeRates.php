<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BikeRates extends Model
{
    use HasFactory;

    protected $table = 'bikeRates';
    protected $fillable = [
        'bike_id',
        'stars' ,
        'price_performance' ,
        'descend' ,
        'ascend',
        'agility',
        'opinion'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function bike(){
        return $this->belongsTo(Bike::class);
    }
}
