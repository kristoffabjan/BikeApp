@extends('layouts.index')

@section('content')
<div class="products-catagories-area clearfix">
    <div class="amado-pro-catagory clearfix">

        @foreach ($shops as $shop)
            <div class="single-products-catagory clearfix">
                <a href="{{route('shop.profile', $shop)}}">
                    <img src="/storage/shops_profile_images/{{$shop->profile_image}}" alt="">
                    <!-- Hover Content -->
                    <div class="hover-content">
                        <div class="line"></div>
                        <p>by: {{$shop->user->name}}</p>
                        <h4>{{$shop->name}} bike shop</h4>
                    </div>
                </a>
            </div>
        @endforeach
        
    </div>
</div>
@endsection
