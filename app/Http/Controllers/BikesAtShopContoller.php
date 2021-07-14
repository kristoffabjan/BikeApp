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
        $bikes_at_shop = BikesAtShop::where('shop_id', $shop->id)->get();
        $bikes = Bike::get();
        return view('shops/addBikesToShop',[
            'shop' => $shop,
            'bikes' => $bikes,
            'bikes_at_shop' => $bikes_at_shop
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
        $match = ['shop_id' => $shop->id, 'bike_id' => $bike->id];
        $deletedRows = BikesAtShop::where($match)->delete();
        return redirect()->route('shop.profile', $shop->id);
        #back();
    }
}
