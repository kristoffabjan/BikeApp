<?php

namespace App\Http\Controllers;

use App\Models\Bike;
use App\Models\Test;
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

    public function edit_test_form(Test $test, Bike $bike)
    {
        return view('bikes.editTest', [
            'test' => $test,
            'bike' => $bike
        ]);
    }

    public function edit_test( Request $request, Test $test, Bike $bike)
    {
        $data = $request->all();

        foreach ($data as $key =>$value) {
            if ($key != "_token") {
                if ($value != "Open this select menu") {
                        if ($value != null) {
                                $affected = Test::where('id', $test->id)
                                ->update([$key => $value]);
                        }
                }
            }
        }

        return redirect()->route('rate.bike', $bike);
    }

    public function destroy(Test $test)
    {   
        $deletedRows = Test::where('id', $test->id)->delete();
        return back();
    }
}
