<?php

namespace App\Http\Controllers;

use App\Models\Bike;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function showProfile($id){
        dd($id);
        return view('biker.userProfile',[
            'user' => $id
        ]);
    }

    public function userProfile(User $user){
        #dd($user);
        $bikes = Bike::where('user_id', $user->id)
                ->get();
        return view('user.userProfile', [
            'user' => $user,
            'bikes' => $bikes
        ]);
    }
}
