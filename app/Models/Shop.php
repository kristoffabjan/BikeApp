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
        'url'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
