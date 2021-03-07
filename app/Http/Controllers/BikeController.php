<?php

namespace App\Http\Controllers;

use App\Models\Bike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BikeController extends Controller
{
    public function index(){
        $bikes = Bike::get();

        return view('layouts.home',[
            'bikes' => $bikes
        ]);
    }

    public function new_bike(){
        return view('newBike');
    }

    public function store(Request $request){
        $this->validate($request, [
            'brand' => ['required'],
            'model' => ['required'],
            'release_date' => ['required'],
            'price' => ['required'],
            'suspension_range' => ['required'],
            'url' => ['required'],
            'profile_image' => 'mimes:jpeg,jpg,png,gif|nullable|max:1999'
        ]);

        

        if ($request->hasFile('profile_image')) {
            #complete filename
            $fileNameWithExt = $request->file('profile_image')->getClientOriginalName();
            #filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            #EXT
            $extension = $request->file('profile_image')->getClientOriginalExtension();
            #filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('profile_image')->storeAs('public/bikes_profile_images', $fileNameToStore);
        }else {
            $fileNameToStore = "noimage.jpg";
        }

        
        $request->user()->bikes()->create([
            'brand' => $request->brand,
            'model' => $request->model,
            'release_date' => $request->release_date,
            'price' => $request->price,
            'suspension_range' => $request->suspension_range,
            'url' => $request->url,
            'profile_image' => $fileNameToStore
        ]);

        #Bike::create([
         #   'brand' => $request->brand,
          #  'model' => $request->model,
           # 'release_date' => $request->release_date,
            #'price' => $request->price,
            #'suspension_range' => $request->suspension_range,
            #'user_id' => Auth::id(),
            #'url' => $request->url,
            #"updated_at" => $request->date_create,
            #"created_at" => $request->date_create
        #]);

        return redirect()->route('home');
    }
}

