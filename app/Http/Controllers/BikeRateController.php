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
}
