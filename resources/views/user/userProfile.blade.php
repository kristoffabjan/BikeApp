@extends('layouts.index')

@section('content')
<div class="container">
    <div class="d-flex-column">
        <h2>Username: {{$user->name}}</h2>
    </div>
    <div class="row justify-content-center d-flex-column">
        

        <div class="col d-flex-column">
            <h4>Bikes uploaded by user:</h4>
           @foreach ($bikes as $bike)
            <div class=" card mb-4 d-flex-column pl-2">
                <div class="pt-2 pb-2">
                    <a href="{{route('profile.user', $bike->user)}}" class="font-weight-bold text-dark mb-2 mr-2">Added by: {{$user->name}}</a>
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

        <div class="col d-flex-column">
            <h4>Shops uploaded by user:</h4>
            @foreach ($shops as $shop)
             <div class=" card mb-4 d-flex-column pl-2">
                 <div class="pt-2 pb-2">
                     <a href="{{route('profile.user', $shop->user)}}" class="font-weight-bold text-dark mb-2 mr-2">Added by: {{$user->name}}</a>
                     <span class="text-secondary text-sm" style="font-size: small;"> {{$shop->created_at->diffForHumans()}}</span>
                     <a style="float: right" class="pr-3" href="{{$bike->url}}">Official site</a>
                 </div>
                 <div class="pb-2 d-flex-column">
                     <h2 class="pr-3">{{$shop->name}}</h2>
                     <h3 class="pt-1">{{$shop->address}}</h3>
                     <h4 class="pt-1">{{$shop->post}}</h4>
                 </div>
                 <div>
                     <span class="text-dark text-md" style="font-size: medium;"> Price: {{$bike->price}}</span>
                 </div>
                 <ul>
                    <li> <strong>Phone number:</strong>  {{$shop->tel}}</li>
                     <li> <strong>Email:</strong>  {{$shop->email}}</li>
                     <li><strong>Website:</strong> {{$bike->url}}</li>
                 </ul>
             </div>
            @endforeach
         </div>

    </div>
</div>
@endsection
