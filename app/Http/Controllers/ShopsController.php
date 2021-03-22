<?php

namespace App\Http\Controllers;

use App\Models\BikesAtShop;
use App\Models\Shop;
use App\Models\ShopImages;
use App\Models\ShopRates;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'profile_image' => 'mimes:jpeg,jpg,png,gif|nullable|max:1999'
        ]);

        if ($request->hasFile('profile_image') ) {
            #filename w ext
            $fileNameWithExt = $request->file('profile_image')->getClientOriginalName();
            #filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            #EXT
            $extension = $request->file('profile_image')->getClientOriginalExtension();
            #filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('profile_image')->storeAs('public/shops_profile_images', $fileNameToStore);
        }else {
            $fileNameToStore = "noimage.jpg";   
        }

        
        $request->user()->shops()->create([
            'name' => $request->name,
            'address' => $request->address,
            'post' => $request->post,
            'tel' => $request->tel,
            'email' => $request->email,
            'url' => $request->url,
            'profile_image' => $fileNameToStore
        ]);

        return redirect()->route('shops');
    }

    public function shopProfile(Shop $shop) 
    {
        $rates = ShopRates::where('shop_id', $shop->id)
                ->get();
        $images = ShopImages::where('shop_id', $shop->id)
                ->get();
        $bikes_at_shop = BikesAtShop::where('shop_id', $shop->id)
                ->get();
        return view('shops.shopProfile', [
            'shop' => $shop,
            'rates' => $rates,
            'images' => $images,
            'bikes_at_shop' => $bikes_at_shop
        ]);
    }

    public function viewShopsForm()
    {
        return view('shops.shopsForm');
    }

    public function storeImages(Request $request, $shopId)
    {
        if ($request->hasFile('images')) {

            foreach ($request->file('images') as  $image) {
                #complete filename
                $fileNameWithExt = $image->getClientOriginalName();
                #filename
                $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                #EXT
                $extension = $image->getClientOriginalExtension();
                #filename to store
                $fileNameToStore = $filename.'_'.time().'.'.$extension;
                $path = $image->storeAs('public/shop_images', $fileNameToStore);

                

                $bikeImage = new ShopImages();
                $bikeImage->shop_id = $shopId;
                $bikeImage->path = $fileNameToStore;
                $bikeImage->save();

            }
        }
        return redirect()->route('shop.profile', $shopId);
    }
}
