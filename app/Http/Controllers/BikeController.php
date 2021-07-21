<?php

namespace App\Http\Controllers;

use App\Models\Bike;
use App\Models\BikeImages;
use App\Models\BikeRates;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BikeController extends Controller
{
    public function index(){
        $bikes = Bike::get();
        $brands = $bikes->unique('brand');

        return view('layouts.home',[
            'bikes' => $bikes,
            'brands' => $brands
        ]);
    }

    public function new_bike(){
        return view('newBike');
    }

    public function sort(Request $request)
    {
        $bikes = Bike::get();
        $brands = $bikes->unique('brand');
        #dd("heree");
        switch ($request->sort) {
            case 'old':
                $sorted = $bikes->sortByDesc('release_date');
                return view('layouts.home', [
                    'bikes' => $sorted,
                    'brands' => $brands
                ]);
                break;

            case 'new':
                $sorted1 = $bikes->sortBy('release_date');
                return view('layouts.home', [
                    'bikes' => $sorted1,
                    'brands' => $brands
                ]);
                break;

            case 'top':
                $joined = DB::table('bikeRates')
                    ->selectRaw(' bike_id,  AVG(stars) as stars')
                    ->join('bikes', 'bikeRates.bike_id', '=', 'bikes.id')
                    ->groupBy('bike_id')
                    ->orderBy('stars', 'desc')
                    ->get();

                $sorted = $joined->pluck('bike_id');
                $top_bikes = collect();

                #top bikes
                foreach ($sorted as $key => $value) {
                    $top_bike = Bike::where('id', $value)->get();
                    $top_bikes = $top_bikes->merge($top_bike);
                }

                #dd($top_bikes);

                return view('layouts.home', [
                    'bikes' => $top_bikes,
                    'brands' => $brands
                ]);
                break;

            case 'expensive':
                $sorted2 = $bikes->sortByDesc('price');
                return view('layouts.home', [
                    'bikes' => $sorted2,
                    'brands' => $brands
                ]);
                break;

            case 'cheap':
                $sorted3 = $bikes->sortBy('price');
                return view('layouts.home', [
                    'bikes' => $sorted3,
                    'brands' => $brands
                ]);
                break;
            
            default:
                return $this->index();
                break;
        }
        
    }

    public function bike_attributes(Request $request)
    {
        $bikes_all = Bike::get();
        $just_brands = $bikes_all->unique('brand');
        $brands = array();

        #select just wanted brands
        foreach ($request->all() as $key => $value) {
            if ($key > 0) {
                array_push($brands, $value);
            }
        }

        #show all bikes if no brand is chosen
        #$bike_brands are bikes to be shown on home page
        if (count($brands) > 0) {
            $bike_brands = Bike::whereIn('brand', $brands)->get();
        }else {
            $bike_brands = $bikes_all;
        }
        
        
        #from price cant bi higher than to price
        if (($request->from_price >= $request->to_price) || ($request->from_sus >= $request->to_sus)) {
            return $this->index();
        }else {
            $bikes = $bike_brands->where('suspension_range', '>', $request->from_sus)
                ->where('suspension_range', '<', $request->to_sus)
                ->where('price', '>', $request->from_price)
                ->where('price', '<', $request->to_price);
            return view('layouts.home', [
                'bikes' => $bikes,
                'brands' => $just_brands
            ]);    
        }
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
            #$fileNameWithExt = $request->file('profile_image')->getClientOriginalName();
            #filename
            #$filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            #EXT
            #$extension = $request->file('profile_image')->getClientOriginalExtension();
            #filename to store
            #$fileNameToStore = $filename.'_'.time().'.'.$extension;
            #$path = $request->file('profile_image')->storeAs('public/bikes_profile_images', $fileNameToStore);
            $fileNameToStore = $request->file('profile_image')->store('bike_profile_images', 's3');
        }else {
            $fileNameToStore = "noimage.jpg";
        }

        #set images to be seen publicly
        #if you want all files to be public, change filesystems file
        Storage::disk('s3')->setVisibility($fileNameToStore, 'public');


        #dd(Storage::disk('s3')->url($fileNameToStore));
        
        $request->user()->bikes()->create([
            'brand' => $request->brand,
            'model' => $request->model,
            'release_date' => $request->release_date,
            'price' => $request->price,
            'suspension_range' => $request->suspension_range,
            'url' => $request->url,
            'profile_image' => Storage::disk('s3')->url($fileNameToStore)
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
                #$fileNameWithExt = $image->getClientOriginalName();
                #filename
                #$filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                #EXT
                #$extension = $image->getClientOriginalExtension();
                #filename to store
                $fileNameToStore = $image->store('bike_images', 's3');
                #$path = $image->storeAs('public/bike_images', $fileNameToStore);
                Storage::disk('s3')->setVisibility($fileNameToStore, 'public');

                

                $bikeImage = new BikeImages();
                $bikeImage->bike_id = $bikeId;
                $bikeImage->path = Storage::disk('s3')->url($fileNameToStore);
                $bikeImage->save();

            }
        }
        return redirect()->route('rate.bike', $bikeId);
    }

    public function destroy(Bike $bike)
    {
        $deletedRows = Bike::where('id', $bike->id)->delete();
        $bikes = Bike::get();

        return view('layouts.home',[
            'bikes' => $bikes
        ]);
    }

    public function edit_form(Bike $bike)
    {
        return view('bikes.updateBike', [
            'bike' => $bike
        ]);
    }

    public function edit(Request $request, Bike $bike)
    {
        $data = $request->all();

        foreach ($data as $key =>$value) {
            if ($key != "_token") {
                if ($value != null) {
                    $affected = Bike::where('id', $bike->id)
                        ->update([$key => $value]);
                }
            }
        }
        
        return redirect()->route('rate.bike', $bike->id);
    }
}

