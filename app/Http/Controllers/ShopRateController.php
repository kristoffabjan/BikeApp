<?php

namespace App\Http\Controllers;

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
}
