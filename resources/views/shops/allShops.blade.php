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
            <div class=" card mb-4 d-flex-column pl-2">
                <div class="pt-2 pb-2">
                    <a href="" class="font-weight-bold text-dark mb-2 mr-2">Added by: {{$shop->user->name}}</a><span class="text-secondary text-sm" style="font-size: small;"> {{$shop->created_at->diffForHumans()}}</span>
                </div>
                <div class="pb-2">
                    <h2><a href="{{route('shop.profile', $shop)}}">{{$shop->name}}</a></h2>
                </div>
                <div>
                    <a href="">
                        <h3>{{$shop->address}}</h3>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
