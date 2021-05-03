<div class="single-product-area section-padding-100 clearfix">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12 col-lg-7">
                <div class="single_product_thumb">
                    <div id="product_details_slider" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">

                            @foreach ($images as $image)
                                @if ($image == $images[0])
                                    <div class="carousel-item active">
                                        <a class="gallery_img" href="/storage/bike_images/{{$image->path}}">
                                            <img class="d-block w-100" src="/storage/bike_images/{{$image->path}}" alt="First slide">
                                        </a>
                                    </div> 
                                @else
                                <div class="carousel-item ">
                                    <a class="gallery_img" href="/storage/bike_images/{{$image->path}}">
                                        <img class="d-block w-100" src="/storage/bike_images/{{$image->path}}" alt="Non-first slide">
                                    </a>
                                </div> 
                                @endif
                            
                            @endforeach

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
            </div>
            <div class="col-12 col-lg-5">
                <div class="single_product_desc">
                    <!-- Product Meta Data -->
                    <div class="product-meta-data">
                        <div class="line"></div>
                        <p class="product-price">from {{$bike->price}}€</p>
                        <a href="product-details.html">
                            <h6>{{$bike->brand}} {{$bike->model}} </h6>
                        </a>
                        <!-- Ratings & Review -->
                        <div class="ratings-review mb-15 d-flex align-items-center justify-content-between">
                            <div class="ratings">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                            </div>
                            @auth
                                <div class="review">
                                    <a href="#">Add images</a>
                                    <a href="{{route('edit.bike', $bike)}}">Edit</a>
                                    <a href="{{route('delete.bike', $bike)}}">Delete</a>
                                </div>
                            @endauth
                        </div>
                        <!-- Avaiable -->
                        <p class="avaibility"><i class="fa fa-person"></i>{{$bike->user->name}}</p>
                        <p class="avaibility"><i class="fa fa-person"></i>{{date('Y', $bike->release_date)}}</p>
                    </div>

                    <div class="short_overview my-5 d-flex flex-column">
                        <ul>
                            <li>Frame suspension: </strong>{{$bike->suspension_range}}mm</li>
                            <li>URL:<a href="{{$bike->url}}">link to official page</a></li>
                        </ul>

                        <div class="about d-flex">
                            <b class="mr-2 mt-1">Average overall rating: <span id=stars></span></b>
                            <span class="text-secondary text-sm pt-1" style="font-size: small;"> {{$stars}}</span>
                        </div>
                        <div class="about d-flex">
                            <b class="mr-2 mt-1">Price-performance: <span id=pp></span></b>
                            <span class="text-secondary text-sm pt-1" style="font-size: small;"> {{$pp}}</span>
                        </div>
                        <div class="about d-flex">
                            <b class="mr-2 mt-1">Descend: <span id=descend></span></b>
                            <span class="text-secondary text-sm pt-1" style="font-size: small;"> {{$descend}}</span>
                        </div>
                        <div class="about d-flex">
                            <b class="mr-2 mt-1">Ascend: <span id=ascend></span></b>
                            <span class="text-secondary text-sm pt-1" style="font-size: small;"> {{$ascend}}</span>
                        </div>
                        <div class="about d-flex">
                            <b class="mr-2 mt-1">Agility: <span id=agility></span></b>
                            <span class="text-secondary text-sm pt-1" style="font-size: small;"> {{$agility}}</span>
                        </div>
                    </div>

                    <!-- Add to Cart Form -->
                    <form class="cart clearfix" method="post">
                        <div class="cart-btn d-flex mb-50">
                            <p>Add more images</p>
                            <div class="quantity">
                                <form action="{{route('bikeImages', $bike->id)}}" method="post" enctype="multipart/form-data">
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
                            </div>
                        </div>
                        <button type="submit" name="addtocart" value="5" class="btn amado-btn">Add to cart</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
---------------------------------
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
                                <img class="img-fluid" src="/storage/bikes_profile_images/{{$bike->profile_image}}" id="bikeProfileImage" alt="">
                                <
                            </div>
                            <h3>{{$bike->brand}}</h3>
                        </div>
                        <div class="about">
                            <h4>{{$bike->model}}</h4>
                        </div>
                        <div class="d-flex flex-column">
                            @guest 
                            @else
                                <p class="mt-2" style="font-size: 1em">Add more images:</p>

                                    <form action="{{route('bikeImages', $bike->id)}}" method="post" enctype="multipart/form-data">
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
                                    <div class="ml-4 d-flex flex-column  justify-content-center  w-100 h-100 pr-4" >
                                        <a class="btn btn-dark btn-md text-light mb-2" href="{{route('edit.bike', $bike)}}"  role="button"
                                        id="addButton" style="color: rgb(110, 155, 37)">Edit</a>
                                        <a class="btn btn-dark btn-md text-light bg-danger" href="{{route('delete.bike', $bike)}}"  role="button"
                                        id="addButton" style="color: rgb(211, 105, 105)">Delete</a>
                                    </div>
                            @endguest
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
            <div class="card h-70">
                <div class="card-body">
                    <ul>
                        <li><strong> Posted by:</strong> {{$bike->user->name}}</li>
                        <li><strong> Released:</strong> {{$bike->release_date}}</li>
                        <li><strong> Price:</strong> {{$bike->price}}€</li>
                        <li><strong> Frame suspension: </strong>{{$bike->suspension_range}}mm</li>
                        <li><strong> URL:</strong> <a href="{{$bike->url}}">link to official page</a></li>
                    </ul>
                    <div class="d-flex-column pl-2 mb-2">
                        <div class="about d-flex">
                            <b class="mr-2 mt-1">Average overall rating: <span id=stars></span></b>
                            <span class="text-secondary text-sm pt-1" style="font-size: small;"> {{$stars}}</span>
                        </div>
                        <div class="about d-flex">
                            <b class="mr-2 mt-1">Price-performance: <span id=pp></span></b>
                            <span class="text-secondary text-sm pt-1" style="font-size: small;"> {{$pp}}</span>
                        </div>
                        <div class="about d-flex">
                            <b class="mr-2 mt-1">Descend: <span id=descend></span></b>
                            <span class="text-secondary text-sm pt-1" style="font-size: small;"> {{$descend}}</span>
                        </div>
                        <div class="about d-flex">
                            <b class="mr-2 mt-1">Ascend: <span id=ascend></span></b>
                            <span class="text-secondary text-sm pt-1" style="font-size: small;"> {{$ascend}}</span>
                        </div>
                        <div class="about d-flex">
                            <b class="mr-2 mt-1">Agility: <span id=agility></span></b>
                            <span class="text-secondary text-sm pt-1" style="font-size: small;"> {{$agility}}</span>
                        </div>
                    </div>
                    <a class="btn btn-dark btn-lg btn-block" href="{{route('new.test', $bike->id)}}" role="button">Add official test of this bike</a>
                </div>
            </div>
            </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div id="carouselExampleControls" class="carousel slide w-500" data-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($images as $image)
                            @if ($image == $images[0])
                                <div class="carousel-item active">
                                    <img class="d-block w-100" src="/storage/bike_images/{{$image->path}}" alt="First slide">
                                </div> 
                            @else
                            <div class="carousel-item ">
                                <img class="d-block w-100" src="/storage/bike_images/{{$image->path}}" alt="First slide">
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
        @guest
         <h4 class="pl-3">Please <a href="{{ route('login') }}">login</a> or <a href="{{ route('register') }}">register</a> to rate this bike.  </h4>
         @else
            @if (!$bike->createdBy(Auth::user(), $bike))
                @if (!$bike->hasRated(Auth::user()))
                    <h2 class="mb-2">Rate this bike:</h2>
                    <div class="card p-3">
                        <form action="{{route('rate.bike.form', $bike->id)}}" method="post">
                            @csrf
                            <div class="d-flex-column">


                                <div class="form-group row">
                                    <label for="brand" class="col-sm-2 col-form-label ">Overal rate</label>
                                    <select class="form-select ml-4" name="overal" aria-label="Default select example" required>
                                        <option selected>Open this select menu</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>

                                <div class="form-group row">
                                    <label for="brand" class="col-sm-2 col-form-label ">Price/performance</label>
                                    <select class="form-select ml-4" name="pp" aria-label="Default select example" required>
                                        <option selected>Open this select menu</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>

                                <div class="form-group row">
                                    <label for="brand" class="col-sm-2 col-form-label ">Ascend</label>
                                    <select class="form-select ml-4" name="ascend" aria-label="Default select example" required>
                                        <option selected>Open this select menu</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>

                                <div class="form-group row">
                                    <label for="brand" class="col-sm-2 col-form-label ">Descend</label>
                                    <select class="form-select ml-4" name="descend" aria-label="Default select example" required>
                                        <option selected>Open this select menu</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>

                                <div class="form-group row">
                                    <label for="brand" class="col-sm-2 col-form-label ">Agility</label>
                                    <select class="form-select ml-4" name="agility" aria-label="Default select example" required>
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
                                        <button type="submit" class="btn btn-primary btn-dark">Submit rate</button>
                                    </div>
                                </div>
                            </div>    
                        </form>
                    </div>
                @endif
            @endif
        @endguest
        <div class="row mt-3">
            <div class="col">
                <h2>Users rates:</h2>
                @foreach ($rates as $rate)
                    <div class="card mt-3 d-flex p-2">
                        <div class="d-flex flex-column">
                            <h3>Posted by: {{$rate->user->name}}</h3>
                            <ul>
                                <li>Overal rate: {{$rate->stars}}</li>
                                <li>Price-performance:  {{$rate->price_performance}}</li>
                                <li>Descending: {{$rate->descend}}</li>
                                <li>Ascending: {{$rate->ascend}}</li>
                                <li>Agility: {{$rate->agility}}</li>
                                <li>Riders opinion: {{$rate->opinion}}</li>
                            </ul>
                        </div>
                        @auth
                            @if ($rate->createdBy(Auth::user(), $rate))
                                <div class="ml-auto d-flex flex-column  justify-content-center  pr-4 " >
                                    <a class="btn btn-dark btn-md text-light mb-2" href="{{route('edit.bike.rate', [$rate, $bike])}}"  role="button"
                                    id="addButton" style="color: rgb(110, 155, 37)">Edit</a>
                                    <a class="btn btn-dark btn-md text-light bg-danger" href="{{route('destroy.bike.rate', $rate)}}"  role="button"
                                    id="addButton" style="color: rgb(211, 105, 105)">Delete</a>
                                </div>
                            @endif
                        @endauth
                    </div>
                @endforeach
            </div>
            <div class="col">
                <h2>Official reviews:</h2>
                @foreach ($tests as $test)
                    <div>
                        <div class="card mt-3 d-flex-column p-2">
                            <h3> {{$test->name}}</h3>
                            <h4>{{$test->magazine}}</h4>
                            <a class="btn btn-dark btn-lg btn-block" href="{{$test->url}}" role="button">Link</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
            
        
</div>
<script>
    document.getElementById("stars").innerHTML = getStars({{$stars}});
    document.getElementById("pp").innerHTML = getStars({{$pp}});
    document.getElementById("ascend").innerHTML = getStars({{$ascend}});
    document.getElementById("descend").innerHTML = getStars({{$descend}});
    document.getElementById("agility").innerHTML = getStars({{$agility}});

    function getStars(rating) {

        // Round to nearest half
        rating = Math.round(rating * 2) / 2;
        let output = [];

        // Append all the filled whole stars
        for (var i = rating; i >= 1; i--)
            output.push('<i class="fa fa-star" aria-hidden="true" style="color: gold;"></i>&nbsp;');

        // If there is a half a star, append it
        if (i == .5) output.push('<i class="fa fa-star-half-o" aria-hidden="true" style="color: gold;"></i>&nbsp;');

        // Fill the empty stars
        for (let i = (5 - rating); i >= 1; i--)
            output.push('<i class="fa fa-star-o" aria-hidden="true" style="color: gold;"></i>&nbsp;');

        return output.join('');
    }
</script>
@endsection
