<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;

class ShopsController extends Controller
{
    public function index()
    {
        $shops = Shop::get();
        return view('shops.allShops',[
            'shops' => $shops
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required'],
            'address' => ['required'],
            'post' => ['required'],
            'tel' => ['required'],
            'email' => ['required'],
            'url' => ['required'],
        ]);

        
        $request->user()->shops()->create([
            'name' => $request->name,
            'address' => $request->address,
            'post' => $request->post,
            'tel' => $request->tel,
            'email' => $request->email,
            'url' => $request->url,
        ]);

        return redirect()->route('shops');
    }

    public function shopProfile(Shop $shop) 
    {
        return view('shops.shopProfile', [
            'shop' => $shop
        ]);
    }

    public function viewShopsForm()
    {
        return view('shops.shopsForm');
    }
}
