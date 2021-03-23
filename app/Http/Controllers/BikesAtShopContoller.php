<?php

namespace App\Http\Controllers;

use App\Models\Bike;
use App\Models\BikesAtShop;
use App\Models\Shop;
use Illuminate\Http\Request;

class BikesAtShopContoller extends Controller
{

    public function __construct()
    {
        return $this->middleware(['auth'])->except('index');
    }

    public function index(Shop $shop)
    {
        $bikes = Bike::get();
        return view('shops/addBikesToShop',[
            'shop' => $shop,
            'bikes' => $bikes
        ]);
    }

    public function store(Shop $shop, Bike $bike)
    {
        $newEntry = new BikesAtShop();
        $newEntry->shop_id = $shop->id;
        $newEntry->bike_id = $bike->id;
        $newEntry->save();

        return redirect()->route('bikeToShop', $shop->id);
    }

    public function destroyEntry(Shop $shop, Bike $bike)
    {
        
        $deletedRows = BikesAtShop::where('shop_id', $shop->id)->where('bike_id', $bike->id)->delete();
        return back();
    }
}
