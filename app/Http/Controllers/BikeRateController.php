<?php

namespace App\Http\Controllers;

use App\Models\Bike;
use App\Models\BikeImages;
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
        $images = BikeImages::where('bike_id', $bike->id)
                ->get();


        return view('bikes.bikeProfile', [
            'bike'=> $bike,
            'rates' => $rates,
            'stars' => $stars,
            'pp' => $pp,
            'ascend' => $ascend,
            'descend' => $descend,
            'agility' => $agility,
            'tests' => $tests,
            'images' => $images
        ]);
    }

    public function store(Request $request, Bike $bike)
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
            'bike_id' => $bike->id,
            'stars' => $request->overal,
            'price_performance' => $request->pp,
            'descend' => $request->descend,
            'ascend' => $request->ascend,
            'agility' => $request->agility,
            'opinion' => $request->opinion,
        ]);

       
       

        return redirect()->route('rate.bike', $bike);

    }

    public function destroy(BikeRates $rate)
    {
        $deletedRows = BikeRates::where('id', $rate->id)->delete();
        return back();
    }

    public function rate_form(Bike $bike)
    {
        return view('bikes.rateBike',[
            'bike' => $bike
        ]);
    }

    public function edit_form(BikeRates $rate, Bike $bike)
    {
        return view('bikes.editBikeRate', [
            'rate' => $rate,
            'bike' => $bike
        ]);
    }

    public function edit(Request $request, BikeRates $rate, Bike $bike)
    {
        $data = $request->all();
        #dd($data);

        foreach ($data as $key =>$value) {
            if ($key != "_token") {
                if ($value != "Open this select menu") {
                        if ($value != null) {
                                $affected = BikeRates::where('id', $rate->id)
                                ->update([$key => $value]);
                        }
                }
            }
        }
        
        return redirect()->route('rate.bike', $bike);
    }
}
