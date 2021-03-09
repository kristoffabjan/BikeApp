<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function insert($bikeId)
    {
        return view('bikes.newTest',[
            'bikeId' => $bikeId
        ]);
    }

    public function create(Request $request, $bikeId)
    {
        $this->validate($request, [
            'name' => ['required'],
            'magazine' => ['required'],
            'url' => ['required'],
        ]);

        $request->user()->tests()->create([
            'bike_id' => $bikeId,
            'name' => $request->name,
            'magazine' => $request->magazine,
            'url' => $request->url
        ]);

        return redirect()->route('rate.bike', $bikeId);
    }
}
