<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\ShopRates;
use Illuminate\Http\Request;

class ShopRateController extends Controller
{
    public function store(Request $request, $shopId)
    {
        $this->validate($request, [
            'stars' => ['required'],
            'opinion' => 'required'
        ]);

        $request->user()->shop_rates()->create([
            'shop_id' => $shopId,
            'stars' => $request->stars,
            'opinion' => $request->opinion,
        ]);

        return redirect()->route('shop.profile', $shopId);
    }

    public function destroy(ShopRates $rate)
    {
        $deletedRows = ShopRates::where('id', $rate->id)->delete();
        return back();
    }

    public function edit_form(ShopRates $rate, Shop $shop)
    {
        return view('shops.editShopRate', [
            'rate' => $rate,
            'shop' => $shop
        ]);
    }

    public function edit(Request $request, ShopRates $rate, Shop $shop)
    {
        $data = $request->all();

        foreach ($data as $key =>$value) {
            if ($key != "_token") {
                if ($value != null) {
                    $affected = ShopRates::where('id', $rate->id)
                        ->update([$key => $value]);
                }
            }
        }
        
        return redirect()->route('shop.profile', $shop);
    }

    public function rate_form(Shop $shop)
    {
        return view('shops.rateShop',[
            'shop' => $shop
        ]);
    }
}
