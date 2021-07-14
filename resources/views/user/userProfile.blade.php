@extends('layouts.index')

@section('content')
<div class="container">
    <div class="row py-5 px-4">
        <div class="col-md-12 mx-auto">
            <!-- Profile widget -->
            <div class="bg-white shadow rounded overflow-hidden">
                <div class="px-4 pt-0 pb-4 cover">
                    <div class="media align-items-end profile-head">
                        <div class="profile mr-3"><img src="https://pointchurch.com/wp-content/uploads/2019/02/Blank-Person-Image.png" alt="..." width="130" class="rounded mb-2 img-thumbnail"><a href="#" class="btn btn-outline-dark btn-sm btn-block">Edit profile</a></div>
                        <div class="media-body mb-5 text-white">
                            <h4 class="mt-0 mb-0" style="color: white">{{$user->name}}</h4>
                            <p class="small mb-4"> <i class="fas fa-map-marker-alt mr-2"></i>New York</p>
                        </div>
                    </div>
                </div>
                <div class="bg-light p-4 d-flex justify-content-end text-center">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item">
                            <h5 class="font-weight-bold mb-0 d-block"> {{$nr_bikes}}</h5><small class="text-muted"> <i class="fas fa-user mr-1"></i>Bikes</small>
                        </li>
                        <li class="list-inline-item">
                            <h5 class="font-weight-bold mb-0 d-block">{{$nr_shops}}</h5><small class="text-muted"> <i class="fas fa-user mr-1"></i>Shops</small>
                        </li>
                    </ul>
                </div>
                <div class="px-4 py-3">
                    <h5 class="mb-0">About</h5>
                    <div class="p-4 rounded shadow-sm bg-light">
                        <p class="font-italic mb-0">Web Developer</p>
                        <p class="font-italic mb-0">Lives in Slovenia</p>
                        <p class="font-italic mb-0">Email: {{$user->email}}</p>
                    </div>
                </div>
                <div class="py-4 px-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h5 class="mb-0">Recent contributions:</h5><a href="#" class="btn btn-link text-muted">Show all</a>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 mb-2 pr-lg-1">
                            <!-- Bikes-->
                            <div class="col d-flex flex-column">
                                <h4>Bikes uploaded by user:</h4>
                                @foreach ($bikes as $bike)
                                <div class="card d-flex flex-row  mb-4 pl-2">
                                    <div class="d-flex-columns ">
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
                                    <div class="d-flex flex-column">
                                        @auth
                                        @if ($bike->createdBy(Auth::user(), $bike))
                                            <div class="ml-4 d-flex flex-column  justify-content-center w-100 h-100 pr-4" >
                                                <a class="btn btn-dark btn-md text-light mb-2" href=""  role="button"
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
                        <div class="col-lg-6 mb-2 pr-lg-1">
                            <!-- Shops-->
                            <div class="col d-flex flex-column">
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
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
