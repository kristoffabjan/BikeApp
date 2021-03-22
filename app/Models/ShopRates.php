<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopRates extends Model
{
    use HasFactory;

    protected $table = 'shopRates';
    protected $fillable = [
        'shop_id',
        'stars' ,
        'opinion'
    ];

    

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
}
