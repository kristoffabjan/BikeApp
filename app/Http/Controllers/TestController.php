<?php

namespace App\Http\Controllers;

use App\Models\Bike;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function insert(Bike $bike)
    {
        return view('bikes.newTest',[
            'bike' => $bike
        ]);
    }

    public function create(Request $request, Bike $bike)
    {
        $this->validate($request, [
            'name' => ['required'],
            'magazine' => ['required'],
            'url' => ['required'],
        ]);

        $request->user()->tests()->create([
            'bike_id' => $bike->id,
            'name' => $request->name,
            'magazine' => $request->magazine,
            'url' => $request->url
        ]);

        return redirect()->route('rate.bike', $bike);
    }
}
