<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    protected $fillable = [
        'bike_id',
        'name' ,
        'magazine',
        'url'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function bike()
    {
        return $this->belongsTo(Bike::class);
    }

    public function createdBy(User $user, Test $test)
    {
        if ($test->user_id === $user->id) {
            return true;
        }else {
            return false;
        }
    }
}
