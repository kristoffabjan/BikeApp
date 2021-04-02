@extends('layouts.index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 d-flex-col">
            @guest
            @else
                <a href="{{url('/addShop')}}" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Add bike shop</a>
            @endguest
            <h2 class="mt-3 mb-2">List of shops:</h2>
            @foreach($shops as $shop)

           
            <div class="card d-flex flex-row mb-4  pl-2">

                    <div class="mr-2">
                        <img style="max-width: 200px; max-height:200px;" class="img-thumbnail" src="/storage/shops_profile_images/{{$shop->profile_image}}" alt="">
                    </div>    
                    <div class="d-flex-column">
                        <div class="pt-2 pb-2">
                            <a href="{{route('profile.user', $shop->user)}}" class="font-weight-bold text-dark mb-2 mr-2">Added by: {{$shop->user->name}}</a><span class="text-secondary text-sm" style="font-size: small;"> {{$shop->created_at->diffForHumans()}}</span>
                        </div>
                        <div class="pb-2">
                            <h2><a href="{{route('shop.profile', $shop)}}">{{$shop->name}}</a></h2>
                        </div>
                        <div>
                        <h3>{{$shop->address}}</h3>
                        </div>
                    </div>
                        @auth
                        @if ($shop->createdBy(Auth::user(), $shop))
                            <div class="ml-auto d-flex flex-column  justify-content-center  pr-4 " >
                                <a class="btn btn-dark btn-md text-light mb-2" href=""  role="button"
                                id="addButton" style="color: rgb(110, 155, 37)">Edit</a>
                                <a class="btn btn-dark btn-md text-light bg-danger" href="{{route('delete.shop', $shop)}}"  role="button"
                                id="addButton" style="color: rgb(211, 105, 105)">Delete</a>
                            </div>
                            @endif
                        @endauth
                   
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
