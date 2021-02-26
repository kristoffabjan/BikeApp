<?php

namespace App\Http\Controllers;

use App\Models\Bike;
use App\Models\BikeRates;
use Illuminate\Http\Request;

class BikeRateController extends Controller
{
    

    public function index(Bike $bike)
    {  
        $rates = BikeRates::where('bike_id', $bike->id)
                ->get();
        return view('bikes.bikeProfile', [
            'bike'=> $bike,
            'rates' => $rates
        ]);
    }

    public function store(Request $request, $bikeId)
    {
        $this->validate($request, [
            'overal' => ['required'],
            'pp' => ['required'],
            'ascend' => ['required'],
            'descend' => ['required'],
            'agility' => ['required'],
            'opinion' => ['required'],
        ]);


        $request->user()->rates()->create([
            'bike_id' => $bikeId,
            'stars' => $request->overal,
            'price_performance' => $request->pp,
            'descend' => $request->descend,
            'ascend' => $request->ascend,
            'agility' => $request->agility,
            'opinion' => $request->opinion,
        ]);

       /*  BikeRates::create([
            'stars' => $request->overal,
            'price_performance' => $request->pp,
            'descend' => $request->descend,
            'ascend' => $request->ascend,
            'agility' => $request->agility,
            'opinion' => $request->opinion,
        ]); */
       

        return redirect()->route('home');
    }
}
