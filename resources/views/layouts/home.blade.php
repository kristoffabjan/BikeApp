@extends('layouts.index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 d-flex-col">
            <div class="  mt-3 mb-4 bg-succes justify-content-center d-flex">
                <h3 class="mr-4 mt-2 pt-2">Add another bike to the community!</h3>
                <a class="btn btn-lg btn-success" href="{{route('addNewBike')}}" role="button">Add</a>
            </div>

            @foreach($bikes as $bike)
                <div class=" card mb-4 d-flex-column pl-2">
                    <div class="pt-2 pb-2">
                        <a href="{{route('profile', $bike->user)}}" class="font-weight-bold text-dark mb-2 mr-2">Added by: {{$bike->user->name}}</a><span class="text-secondary text-sm" style="font-size: small;"> {{$bike->created_at->diffForHumans()}}</span>
                    </div>
                    <div class="pb-2">
                        <h2>{{$bike->brand}}</h2>
                    </div>
                    <div>
                        <h3>{{$bike->model}}</h3>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
