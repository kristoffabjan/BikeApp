@extends('layouts.index')

@section('content')
<div class="row ">
    <div class="col-md-12 d-flex-col mt-3">
        <h2>Add bikes that are currently available in your shop:</h2>
        <a class="btn btn-primary btn-lg btn-dark mb-2 ml-2" href="{{ route('shop.profile', $shop) }}" role="button">Back to shop</a>

        @foreach ($bikes as $bike)
            <!-- do not show bikes that are already in shop-->
            @if (!$shop->has_bike($bike))
                <div class="d-flex mb-4 pl-2 border border-dark rounded" >
                    <div class="mr-3">
                        <div class="user-avatar">
                            <img class="img-thumbnail" style="max-width: 250px" src="{{$bike->profile_image}}" alt="">
                        </div>
                    </div>
                    <div class="d-flex-column">
                        <div class="pt-2 pb-2">
                            <a href="{{route('profile.user', $bike->user)}}" class="font-weight-bold text-dark mb-2 mr-2">Added by: {{$bike->user->name}}</a><span class="text-secondary text-sm" style="font-size: small;"> {{$bike->created_at->diffForHumans()}}</span>
                        </div>
                        <div class="pb-2">
                            <h2>{{$bike->brand}}</h2>
                        </div>
                        <div>
                            <a href="{{route('rate.bike', $bike->id)}}">
                                <h3>{{$bike->model}}</h3>
                            </a>
                        </div>
                    </div>
                    <div class="ml-auto d-flex justify-content-center align-items-center pr-4" >
                        <a class="btn btn-dark btn-lg " href="{{route('bikeToShop.add', [$shop, $bike])}}"  role="button"
                        id="addButton">Add</a>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div>

@endsection

