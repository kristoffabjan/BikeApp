<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = [
        'name' ,
        'address' ,
        'post' ,
        'tel',
        'email',
        'url',
        'profile_image'
    ];

    public function createdBy(User $user, Shop $shop)
    {
        if ($user->id === $shop->user_id ) {
            return true;
        }else {
            return false;
        }
    }

    public function hasRated(User $user)
    {
        return $this->rates->contains('user_id', $user->id);
    }

    public function rates()
    {
        return $this->hasMany(ShopRates::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
