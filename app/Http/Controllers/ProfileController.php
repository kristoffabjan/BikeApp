<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeMail;
use App\Models\Bike;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ProfileController extends Controller
{
    #methon not in use
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

    public function edit_profile(User $user)
    {
        return view('user.editUserProfile', [
            'user' => $user
        ]);
    }

    public function edit_profile_data(Request $request, User $user)
    {
        $data = $request->all();

        foreach ($data as $key =>$value) {
            if ($key != "_token") {
                if ($value != null) {
                    $affected = User::where('id', $user->id)
                        ->update([$key => $value]);
                }
            }
        }
        
        return $this->userProfile($user);
    }

    public function destroy(User $user)
    {
        
        $user->delete();
        return redirect()->route('home');
    }

    public function about()
    {
        return view('layouts.about');
    }

    public function send_welcome_mail1(Request $request)
    {
        #$order = Order::findOrFail($request->order_id);
        $user = $request->user();
        if ($user == null) {
            dd($request->email);
            try {
                $new_mail = new WelcomeMail;
                Mail::to($request->email)->send($new_mail->no_user());
                echo 'Mail send successfully';
                return redirect()->route('home');
            } catch (\Exception $e) {
                echo 'Error - '.$e;
                return redirect()->route('home');
            }
        }else {
            dd($$user);
            return redirect()->route('home');
        }
        dd($user);
        // Ship the order...

        Mail::to($request->user())->send(new WelcomeMail($user));
    }

    public function send_welcome_mail(Request $request)
    {
        $user = $request->user();
        if ($user == null) {
            $new_mail = WelcomeMail::no_user();

            Mail::to($request->email)->send($new_mail);
            return redirect()->route('home');
        }else {
            $new_mail = WelcomeMail::user($user);

            Mail::to($user->email)->send($new_mail);
            return redirect()->route('home');
        }
        
    }
}
