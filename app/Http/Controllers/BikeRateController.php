<?php

namespace App\Http\Controllers;

use App\Models\Bike;
use Illuminate\Http\Request;

class BikeRateController extends Controller
{
    
    public function rate(Bike $bike)
    {  
        #dd($bike);
        return view('bikes.bikeProfile', [
            'bike'=> $bike
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'overal' => ['required'],
            'pp' => ['required'],
            'ascend' => ['required'],
            'descend' => ['required'],
            'agility' => ['required'],
            'opinion' => ['required'],
        ]);

        
        $request->user()->bikes()->create([
            'brand' => $request->brand,
            'model' => $request->model,
            'release_date' => $request->release_date,
            'price' => $request->price,
            'suspension_range' => $request->suspension_range,
            'url' => $request->url,
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
