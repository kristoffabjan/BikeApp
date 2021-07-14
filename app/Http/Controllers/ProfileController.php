<?php

namespace App\Http\Controllers;

use App\Models\Bike;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function showProfile(User $user){
        #dd($id);
        $nr_bikes = Bike::where('user_id', $user->id)->get()->count();
        #$nr_bikes = $bikes->count();
        $nr_shops = Shop::where('user_id', $user->id)->get()->count();
        #$nr_shops = $shops->count();

        dd($nr_shops);
        return view('user.userProfile',[
            'user' => $user,
            'nr_bikes' => $nr_bikes,
            'nr_shops' => $nr_shops
        ]);
    }

    public function userProfile(User $user){
        #dd($user);
        $bikes = Bike::where('user_id', $user->id)
                ->get();
        $shops = Shop::where('user_id', $user->id)
                ->get();
        $nr_bikes = Bike::where('user_id', $user->id)->get()->count();
        #$nr_bikes = $bikes->count();
        $nr_shops = Shop::where('user_id', $user->id)->get()->count();
        return view('user.userProfile', [
            'user' => $user,
            'bikes' => $bikes,
            'shops' => $shops,
            'nr_bikes' => $nr_bikes,
            'nr_shops' => $nr_shops
        ]);
    }

    public function about()
    {
        return view('layouts.about');
    }
}
