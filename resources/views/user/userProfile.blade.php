@extends('layouts.index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 d-flex-col">
           <h2>Username: {{$user->name}}</h2>
           <h4>Bikes uploaded by user:</h4>
           @foreach ($bikes as $bike)
            <div class=" card mb-4 d-flex-column pl-2">
                <div class="pt-2 pb-2">
                    <a href="{{route('profile', $bike->user)}}" class="font-weight-bold text-dark mb-2 mr-2">Added by: {{$user->name}}</a>
                    <span class="text-secondary text-sm" style="font-size: small;"> {{$bike->created_at->diffForHumans()}}</span>
                    <a style="float: right" class="pr-3" href="{{$bike->url}}">Official site</a>
                </div>
                <div class="pb-2 d-flex">
                    <h2 class="pr-3">{{$bike->brand}}</h2>
                    <h3 class="pt-1">{{$bike->model}}</h3>
                </div>
                <div>
                    <span class="text-dark text-md" style="font-size: medium;"> Price: {{$bike->price}}</span>
                </div>
                <ul>
                    <li> <strong>Frame suspention(mm):</strong>  {{$bike->suspension_range}}</li>
                    <li><strong>Released:</strong> {{$bike->release_date}}</li>
                </ul>
            </div>
           @endforeach

           
        </div>
    </div>
</div>
@endsection
