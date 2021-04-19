@extends('layouts.index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 d-flex-col">
            @guest
            @else
                <div class="  mt-3 mb-4 bg-succes justify-content-center d-flex">
                    <h3 class="mr-4 mt-2 pt-2">Add another bike to the community!</h3>
                    <a class="btn btn-lg btn-success" href="{{route('addNewBike')}}" role="button">Add</a>
                </div>
            @endguest

            @foreach($bikes as $bike)
                <div class="d-flex mb-4 pl-2 border border-dark rounded">
                    <div class="mr-3">
                        <div class="user-avatar">
                            <img class="img-thumbnail" style="max-width: 250px" src="/storage/bikes_profile_images/{{$bike->profile_image}}" alt="">
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
                   <div class="ml-auto  mr-4">
                        @auth
                             @if ($bike->createdBy(Auth::user(), $bike))
                                <div class="ml-4 d-flex flex-column  justify-content-center  w-100 h-100 pr-4" >
                                    <a class="btn btn-dark btn-md text-light mb-2" href="{{route('edit.bike', $bike)}}"  role="button"
                                    id="addButton" style="color: rgb(110, 155, 37)">Edit</a>
                                    <a class="btn btn-dark btn-md text-light bg-danger" href="{{route('delete.bike', $bike)}}"  role="button"
                                    id="addButton" style="color: rgb(211, 105, 105)">Delete</a>
                                </div>
                            @endif
                        @endauth
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
