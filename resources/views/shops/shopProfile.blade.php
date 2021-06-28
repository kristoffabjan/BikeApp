@extends('layouts.index')

@section('content')
<div class="container d-flex-column">
        <div class="container pb-4">
            <div class="row gutters">
            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                <div class="card h-70">
                    <div class="card-body">
                        <div class="account-settings">
                            <div class="user-profile">
                                <div class="user-avatar">
                                    <img class="img-fluid" src="/images/shops_profile_images/{{$shop->profile_image}}" alt="">
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
            <div class="card h-70">
                <div class="card-body d-flex-column">
                    <h3 class="display-4">{{$shop->name}} bike shop</h3>
                    <h4><strong>Address:</strong> {{$shop->address}}</h4>
                    <h4><strong>Post number:</strong> {{$shop->post}}</h4>
                    <ul>
                        <li><strong> Posted by:</strong> {{$shop->user->name}}</li>
                        <li><strong> Telephone number:</strong> {{$shop->tel}}</li>
                        <li><strong> Email:</strong> {{$shop->email}}</li>
                        <li><strong>  Website:  </strong>{{$shop->url}}</li>
                    </ul>
                    @auth
                        @if ($shop->createdBy(Auth::user(), $shop))
                            <a class="btn btn-dark btn-md text-light bg-dark" href="{{route('edit.shop', $shop)}}"  role="button"
                                id="addButton">Edit</a>
                            <span><a class="btn btn-dark btn-md text-light bg-dark" href="{{route('delete.shop', $shop)}}"  role="button"
                                id="addButton">Delete</a></span>
                        @endif
                    @endauth
                </div>
            </div>
            </div>
            </div>
        </div>
        @auth
        @if ($shop->createdBy(Auth::user(), $shop))
            <div class="row-8 d-flex">
                <div class="col">
                    <div class="" >
                        <div class="d-flex flex-column">
                            @guest 
                            @else
                                <h3 class="mt-2" >Add more images:</h3>
        
                                    <form action="{{route('shopImages', $shop->id)}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group border">
                                            <label for="images" class="col-md col-form-label" style="font-size: 1em">Images</label>
                                            <div class="col-sm-10">
                                            <input type="file" class="form" id="bike_images" name="images[]"  placeholder="Images" multiple >
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-10">
                                                <button type="submit" class="btn btn-primary btn-dark">Add images</button>
                                            </div>
                                        </div>
                                    </form>
                            @endguest
                        </div>
                    </div>
                </div>
                <div class="col ">
                    <h3>Add new bikes available at your shop:</h3>
                    <a class="btn btn-dark btn-lg " href="{{route('bikeToShop', $shop)}}"  role="button">Add</a>
                    <ol id="ollist" style="display: none">
                        <li>loll</li>
                        <li>loll</li>
                        <li>loll</li>
                        <li>loll</li>
                    </ol>
                </div>
            </div>
         @else
        @endif
        @endauth

        @guest
        <div class="row">
            <div class="card">
                <h4 class="pl-3">Please <a href="{{ route('login') }}">login</a> or <a href="{{ route('register') }}">register</a> to rate this bike.  </h4>
            </div>
        </div>
         @else
            @if (!($shop->hasRated(Auth::user())))
                <h2 class="mb-2">Rate this shop:</h2>
                <div class="card p-3 mb-3">
                    <form action="{{route('rate.shop', $shop->id)}}" method="post">
                        @csrf
                        <div class="d-flex-column">


                            <div class="form-group row">
                                <label for="stars" class="col-sm-2 col-form-label ">Overal rate</label>
                                <select class="form-select ml-4" name="stars" aria-label="Default select example" required>
                                    <option selected>Open this select menu</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Users opinion</label>
                                <textarea class="form-control" id="uo" name="opinion" rows="4"></textarea>
                            </div>

                            
                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary btn-dark">Post</button>
                                </div>
                            </div>
                        </div>    
                    </form>
                </div>
            @endif

        <div class="row mt-4 mb-4">
            <div class="col">
                <div id="carouselExampleControls" class="carousel slide w-500" data-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($images as $image)
                                @if ($image == $images[0])
                                    <div class="carousel-item active">
                                        <img class="d-block w-100"  src="/images/shop_images/{{$image->path}}" alt="First slide">
                                    </div> 
                                @else
                                <div class="carousel-item ">
                                    <img class="d-block w-100"   src="/images/shop_images/{{$image->path}}" alt="First slide">
                                </div> 
                                @endif
                                
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                  </div>
            </div>
        </div>

        <h2 class="mt-3">Bikes currently available at this shop:</h2>
        @foreach ($bikes_at_shop as $bike)
             <!-- $bike lists entries from bikeAtShop table, bike is a relation, that each bikeAtShop entry belongs to certain bike -->
            <div class="d-flex mb-4 pl-2 border border-dark rounded">
                    <div class="mr-3">
                        <div class="user-avatar">
                            <img class="img-thumbnail" style="max-width: 250px" src="/images/bikes_profile_images/{{$bike->bike->profile_image}}" alt="">
                        </div>
                    </div>
                    <div class="d-flex-column">
                        <div class="pt-2 pb-2">
                            <a href="{{route('profile.user', $bike->bike->user)}}" class="font-weight-bold text-dark mb-2 mr-2">Added by: {{$bike->bike->user->name}}</a>
                        </div>
                        <div class="pb-2">
                            <h2>{{$bike->bike->brand}}</h2>
                        </div>
                        <div>
                            <a href="{{route('rate.bike', $bike->bike->id)}}">
                                <h3>{{$bike->bike->model}}</h3>
                            </a>
                        </div>
                   </div>
                   @auth
                   @if ($shop->createdBy(Auth::user(), $shop))
                        <div class="ml-auto d-flex justify-content-center align-items-center pr-4" >
                            <a class="btn btn-dark btn-lg bg-danger" href="{{route('bikeToShop.destroy', [$shop,$bike->bike])}}"  role="button"
                            id="addButton">Remove</a>
                        </div>
                    @endif
                    @endauth
                </div>
        @endforeach

        <h2 class="mt-3 mb-2">Users rates:</h2>
        @foreach ($rates as $rate)
        <div class="d-flex mb-4 pl-2 border border-dark rounded">
            <div class="d-flex-column">
                <div class="pt-2 pb-2">
                    <a href="{{route('profile.user', $rate->user)}}" class="font-weight-bold text-dark mb-2 mr-2">Added by: {{$rate->user->name}}</a><span class="text-secondary text-sm" style="font-size: small;"> {{$rate->created_at->diffForHumans()}}</span>
                </div>
                <div class="d-flex ">
                    <div class="p-2">
                        <p>"{{$rate->opinion}}"</p>
                    </div>
                    <div class="d-flex ml-auto p2">
                        <h2>{{$rate->stars}}</h2>
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-star mr-2 ml-1 mt-1" viewBox="0 0 16 16">
                            <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.523-3.356c.329-.314.158-.888-.283-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767l-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288l1.847-3.658 1.846 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.564.564 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
                          </svg>
                    </div>
                    
                </div>
           </div>
           @auth
                @if ($rate->createdBy(Auth::user(), $rate))
                    <div class="ml-auto d-flex flex-column  justify-content-center  pr-4 " >
                        <a class="btn btn-dark btn-md text-light mb-2" href="{{route('edit.shop.rate', [$rate, $shop])}}"  role="button"
                        id="addButton" style="color: rgb(110, 155, 37)">Edit</a>
                        <a class="btn btn-dark btn-md text-light bg-danger" href="{{route('destroy.shop.rate', $rate)}}"  role="button"
                        id="addButton" style="color: rgb(211, 105, 105)">Delete</a>
                    </div>
                @endif
            @endauth
        </div>
        @endforeach

        @endguest
       
          
        
</div>
@endsection
<script>
    function openList() {
        var list = document.getElementById("ollist");
    
        if (list.style.display == "none"){
            list.style.display = "block";
        }else{
            list.style.display = "none";
        }
    }
    </script>