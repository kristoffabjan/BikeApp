<?php

namespace App\Http\Controllers;

use App\Models\Bike;
use App\Models\BikeRates;
use App\Models\Test;
use Illuminate\Http\Request;

class BikeRateController extends Controller
{
    

    public function index(Bike $bike)
    {  
        $rates = BikeRates::where('bike_id', $bike->id)
                ->get();
        $stars = BikeRates::where('bike_id', $bike->id)
                ->avg('stars');
        $pp = BikeRates::where('bike_id', $bike->id)
                ->avg('price_performance');        
        $descend = BikeRates::where('bike_id', $bike->id)
                ->avg('descend');
        $ascend = BikeRates::where('bike_id', $bike->id)
                ->avg('ascend');
        $agility = BikeRates::where('bike_id', $bike->id)
                ->avg('agility');
        $tests = Test::where('bike_id', $bike->id)
                ->get();

        return view('bikes.bikeProfile', [
            'bike'=> $bike,
            'rates' => $rates,
            'stars' => $stars,
            'pp' => $pp,
            'ascend' => $ascend,
            'descend' => $descend,
            'agility' => $agility,
            'tests' => $tests
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
       

        return redirect()->route('rate.bike', $bikeId);

    }
}
