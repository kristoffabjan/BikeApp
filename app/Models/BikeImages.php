<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BikeImages extends Model
{
    use HasFactory;

    protected $fillable = [
        'bike_id',
        'path'
    ];

    public function bike()
    {
        return $this->belongsTo(Bike::class);
    }
}
