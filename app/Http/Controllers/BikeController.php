<?php

namespace App\Http\Controllers;

use App\Models\Bike;
use App\Models\BikeImages;
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

        return redirect()->route('home');
    }

    public function storeImages(Request $request, $bikeId)
    {
       #dd($request->images);
        #$this->validate($request, [
         #   'images' => 'required',
          #  'images.*' => 'mimes:jpeg,jpg,png,gif'
        #]);

        if ($request->hasFile('images')) {

            foreach ($request->file('images') as  $image) {
                #complete filename
                $fileNameWithExt = $image->getClientOriginalName();
                #filename
                $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                #EXT
                $extension = $image->getClientOriginalExtension();
                #filename to store
                $fileNameToStore = $filename.'_'.time().'.'.$extension;
                $path = $image->storeAs('public/bike_images', $fileNameToStore);

                

                $bikeImage = new BikeImages();
                $bikeImage->bike_id = $bikeId;
                $bikeImage->path = $fileNameToStore;
                $bikeImage->save();

            }
        }
        return redirect()->route('rate.bike', $bikeId);
    }
}

