@extends('layouts.index')

@section('content')
<div class="single-product-area section-padding-100 clearfix">
    <div class="container-fluid">

        <div class="row mb-3 mt-3">
            <div class="col-12 col-lg-7">   
                <div class="single_product_thumb">
                    <div id="product_details_slider" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">

                            @foreach ($images as $image)
                                @if ($image == $images[0])
                                    <div class="carousel-item active">
                                        <a class="gallery_img" href="{{$image->path}}">
                                            <img class="d-block w-100" style="max-height: 650px" src="{{$image->path}}" alt="First slide">
                                        </a>
                                    </div> 
                                @else
                                <div class="carousel-item ">
                                    <a class="gallery_img" href="{{$image->path}}">
                                        <img class="d-block w-100" style="max-height: 650px" src="{{$image->path}}" alt="Non-first slide">
                                    </a>
                                </div> 
                                @endif
                            
                            @endforeach

                            <a class="carousel-control-prev" href="#product_details_slider" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#product_details_slider" role="button" data-slide="next">
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
                        <p class="product-price p-2" ><span style="background-color: #3c3c3c; border-radius:15px" class="p-2">from {{$bike->price}}€</span></p>
                        <div class="d-flex">
                            <div class=" mr-auto">
                                <a href="product-details.html">
                                    <h6><strong>{{$bike->brand}} {{$bike->model}} </strong></h6>
                                </a>
                            </div>
                            @auth
                                @if ($bike->createdBy(Auth::user(), $bike))
                                <div class="d-flex flex-wrap ml-auto">
                                    <button  name="addtocart"  class="btn btn-dark btn-sm mr-2 ml-2 mb-2"> 
                                        <a style=" color: white; " class="h5 pt-2" href="{{route('edit.bike', $bike)}}">Edit</a> 
                                    </button>

                                    <form action="{{route('delete.bike', $bike)}}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <input class="btn btn-dark btn-md mr-3" style="font-size: x-large" type="submit" value="Delete">
                                    </form>
                                </div>
                                @endif
                            @endauth
                        </div>
                        <!-- Ratings & Review -->
                        <div class="ratings-review mb-15 d-flex align-items-center justify-content-between">
                            <div class="ratings">
                                <div class="about d-flex">
                                    <b class="mr-2 mt-1"><span id=stars></span></b>
                                </div>
                            </div>
                           
                        </div>
                        <!-- Avaiable -->
                        <a href="{{route('profile.user', $bike->user)}}">
                        <p class="avaibility"><i class="fa fa-user pr-2" aria-hidden="true"></i>{{$bike->user->name}}</p></a>
                        <span class="text-secondary text-sm" style="font-size: small;"> {{$bike->created_at->diffForHumans()}}</span>
                    </div>

                    

                    <div class="short_overview my-5 d-flex flex-column">
                        
                        <ul class="mt-4">
                            <li> <strong>Frame suspension: </strong> {{$bike->suspension_range}}mm</li>
                            <li> <strong>Released at:</strong>  {{$bike->release_date}}</li>

                            <li><a href="{{$bike->url}}">link to official page</a></li>
                        </ul>

                        <div class="about d-flex">
                            <b class="mr-2 mt-1">Price-performance: <span id=pp></span></b>
                        </div>
                        <div class="about d-flex">
                            <b class="mr-2 mt-1">Descend: <span id=descend></span></b>
                        </div>
                        <div class="about d-flex">
                            <b class="mr-2 mt-1">Ascend: <span id=ascend></span></b>
                        </div>
                        <div class="about d-flex">
                            <b class="mr-2 mt-1">Agility: <span id=agility></span></b>
                        </div>
                    </div>

                    @auth
                    <div class="d-flex flex-column">
                        <div class="d-flex flex-wrap">
                            <div class="d-flex justify-content-center align-items-center">
                                <form action="{{route('bikeImages', $bike->id)}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group d-flex flex-column">
                                        <div class="col-sm-10">
                                        <input type="file" class="form" id="bike_images" name="images[]"  placeholder="Images" multiple >
                                        </div>
                                    </div>
                                    <div class="form-group row ml-1">
                                        <div class="col-sm-10">
                                            <button type="submit" class="btn btn-primary btn-dark">Add images</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="d-flex flex-column flex-wrap">
                                <button  name="addtocart"  class="btn amado-btn ">
                                    <a style="font-size: x-large; color: white" href="{{route('new.test.form', $bike)}}">Add review
                                        <i class="fa fa-book"></i>
                                    </a>
                                </button>
                            </div>
                        </div>
                        <div>
                            @if (!$bike->createdBy(Auth::user(), $bike))
                                @if (!$bike->hasRated(Auth::user()))
                                    <button  name="addtocart" style="font-size: x-large" value="5" class="btn amado-btn btn-lg btn-block"> 
                                        <a style="font-size: x-large; color: white" href="{{route('rate.bike.open.form', $bike)}}">Rate bike <i class="fa fa-star"></i></a> 
                                    </button>
                                @endif
                            @endif
                        </div>
                    </div>
                    @endauth
                </div>
            </div>
        </div>
        
        
                
        <div class="row d-flex flew-wrap ">
            <div class="col mr-30 mb-3">
                @if ( $tests->count() > 0 )
                <div class=" d-flex flex-column">
                    <h2><strong>{{ Str::plural('Review', count($tests)) }}: </strong></h2>
                    <div id="product_details_slider2" class="carousel slide" style="min-width: 350px" data-ride="carousel">
                        <div class="carousel-inner">

                            @foreach ($tests as $test)
                                @if ($test == $tests[0])
                                    <div class="carousel-item active">
                                        <div class="card" style="background-color: #fbb710; ; ;color:white">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="mr-auto">
                                                        <a href="{{route('profile.user', $test->user)}}">
                                                            <h5 class="avaibility"><i class="fa fa-user pr-2" aria-hidden="true"></i>{{$test->user->name}}</h5>
                                                        </a>
                                                    </div>
                                                    @auth
                                                        @if ( $test->createdBy( Auth::user(), $test) )
                                                            <div class="d-flex flex-wrap">
                                                                <button  name="addtocart"  value="5" class="btn btn-dark btn-md mr-2 mb-2"> 
                                                                    <a style=" color: white" class="h6" href="{{route('edit.test.form', [$test, $bike])}}">Edit<i class="fa fa-edit ml-1"></i></a> 
                                                                </button>

                                                                <form action="{{route('delete.test', $test)}}" method="POST">
                                                                    @method('DELETE')
                                                                    @csrf
                                                                    <input class="btn btn-dark btn-md mr-3" style="font-size: large" type="submit" value="Delete">
                                                                </form>
                                                            </div>
                                                        @endif
                                                    @endauth
                                                </div>
                                                <ul>
                                                    <li><p>Article: {{$test->name}}</p></li>
                                                    <button class="btn btn-secondary"> <a href="{{$test->url}}">URL</a></button>
                                                </ul>
                                            </div>
                                        </div>
                                    </div> 
                                @else
                                    <div class="carousel-item ">
                                        <div class="card" style="background-color: #fbb710; ;; color:white">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="mr-auto">
                                                        <a href="{{route('profile.user', $test->user)}}">
                                                            <h5 class="avaibility"><i class="fa fa-user pr-2" aria-hidden="true"></i>{{$test->user->name}}</h5>
                                                        </a>
                                                    </div>
                                                    @auth
                                                        @if ( $test->createdBy( Auth::user(), $test) )
                                                            <div class="d-flex">
                                                                <button  name="addtocart"  value="5" class="btn btn-dark btn-md mr-2"> 
                                                                    <a style=" color: white" class="h6" href="{{route('edit.test.form', [$test, $bike])}}">Edit<i class="fa fa-edit ml-1"></i></a> 
                                                                </button>

                                                                <form action="{{route('delete.test', $test)}}" method="POST">
                                                                    @method('DELETE')
                                                                    @csrf
                                                                    <input class="btn btn-dark btn-md mr-3" style="font-size: x-large" type="submit" value="Delete">
                                                                </form>
                                                            </div>
                                                        @endif
                                                    @endauth
                                                </div>
                                                <ul>
                                                    <li><p>Article: {{$test->name}}</p></li>
                                                    <button class="btn btn-secondary"> <a href="{{$test->url}}">URL</a></button>
                                                </ul>
                                            </div>
                                        </div>
                                    </div> 
                                @endif
                            
                            @endforeach

                            <a class="carousel-control-prev" href="#product_details_slider2" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#product_details_slider2" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>

                        </div>
                    </div>
                </div>
                @else
                <div class="single_product_thumb d-flex flex-column">
                    <h2><strong>Tests:</strong></h2>
                    <h5>
                        No magazine tests yet
                    </h5>
                </div>
                @endif
            </div>

            <div class="col mr-30 ">
                @if ( $rates->count() > 0 )
                <div class="single_product_thumb d-flex flex-column mb-3">
                    <h2><strong>{{ Str::plural('Rating', count($rates)) }}: </strong></h2>
                    <div id="product_details_slider1" class="carousel slide " style="min-width: 350px"  data-ride="carousel">
                        <div class="carousel-inner">

                            @foreach ($rates as $rate)
                                @if ($rate == $rates[0])
                                    <div class="carousel-item active">
                                        <div class="card" style="background-color: #fbb710; ;; color:white">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="mr-auto">
                                                        <a href="{{route('profile.user', $rate->user)}}">
                                                            <h5 class="avaibility"><i class="fa fa-user pr-2 " aria-hidden="true"></i>{{$rate->user->name}}</h5>
                                                        </a>
                                                    </div>
                                                    @auth
                                                        @if ($rate->createdBy(Auth::user(), $rate))
                                                        <div class="d-flex flex-wrap">
                                                            <button  name="addtocart"  value="5" class="btn btn-dark btn-md mr- mb-2"> 
                                                                <a style=" color: white" class="h6" href="{{route('edit.bike.rate', [$rate, $bike])}}">Edit<i class="fa fa-edit ml-1"></i></a> 
                                                            </button>

                                                            <form action="{{route('destroy.bike.rate', $rate)}}" method="POST">
                                                                @method('DELETE')
                                                                @csrf
                                                                <input class="btn btn-dark btn-md mr-3" style="font-size: x-large" type="submit" value="Delete">
                                                            </form>
                                                        </div>
                                                        @endif
                                                    @endauth
                                                </div>
                                                
                                                <h5 class="card-subtitle mb-2 text-muted">Overall rate: {{$rate->stars}} <i class="fa fa-star"></i></h5>
                                                <ul>
                                                    <li><p>Price-performace: {{$rate->price_performance}} <i class="fa fa-star"></i></p></li>
                                                    <li><p>Descend: {{$rate->descend}} <i class="fa fa-star"></i></p></li>
                                                    <li><p>Ascend: {{$rate->ascend}} <i class="fa fa-star"></i></p></li>
                                                    <li><p>Agility: {{$rate->agility}} <i class="fa fa-star"></i></p></li>
                                                    <li><p>Opinion: {{$rate->opinion}} <i class="fa fa-star"></i></p></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div> 
                                @else
                                    <div class="carousel-item ">
                                        <div class="card" style="background-color: #fbb710; ;">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="mr-auto">
                                                        <a href="{{route('profile.user', $rate->user)}}">
                                                            <h5 class="avaibility"><i class="fa fa-user pr-2 " aria-hidden="true"></i>{{$rate->user->name}}</h5>
                                                        </a>
                                                    </div>
                                                    @auth
                                                        @if ($rate->createdBy(Auth::user(), $rate))
                                                        <div class="d-flex ">
                                                            <button  name="addtocart"  value="5" class="btn btn-dark btn-md mr-2"> 
                                                                <a style=" color: white" class="h6" href="{{route('edit.bike.rate', [$rate, $bike])}}">Edit<i class="fa fa-edit ml-1"></i></a> 
                                                            </button>

                                                            <form action="{{route('destroy.bike.rate', $rate)}}" method="POST">
                                                                @method('DELETE')
                                                                @csrf
                                                                <input class="btn btn-dark btn-md mr-3" style="font-size: x-large" type="submit" value="Delete">
                                                            </form>
                                                        </div>
                                                        @endif
                                                    @endauth
                                                </div>
                                                
                                                <h5 class="card-subtitle mb-2 text-muted">Overall rate:{{$rate->stars}}</h5>
                                                <ul>
                                                    <li><p>Price-performace: {{$rate->price_performance}}</p></li>
                                                    <li><p>Descend: {{$rate->descend}}</p></li>
                                                    <li><p>Ascend: {{$rate->ascend}}</p></li>
                                                    <li><p>Agility: {{$rate->agility}}</p></li>
                                                    <li><p>Opinion: {{$rate->opinion}}</p></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div> 
                                @endif
                            
                            @endforeach

                            <a class="carousel-control-prev" href="#product_details_slider1" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#product_details_slider1" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>

                        </div>
                    </div>
                </div>
                @else
                    <div class="single_product_thumb d-flex flex-column mb-3">
                        <h2><strong>Rates:</strong></h2>
                        <h5>
                            No rates yet
                        </h5>
                    </div>
                @endif
            </div>

            <div class="col mb-3">
                @if ( $shops->count() > 0)
                <div class="single_product_thumb d-flex flex-column mb-3">
                    <h2><strong>Available at:</strong></h2>
                    <div id="product_details_slider3" class="carousel slide" style="min-width: 350px"  data-ride="carousel">
                        <div class="carousel-inner">

                            @foreach ($shops as $shop)
                                @if ($shop == $shops[0])
                                    <div class="carousel-item active">
                                        <div class="card" style="background-color: #3c3c3c; ;; color:white">
                                            <div class="card-body" style="color: #fbb710">
                                                <a href="">
                                                    <h5 class=" mb-2 " style="color: #fbb710"> 
                                                        <i class="fa fa-user pr-2" aria-hidden="true"></i> 
                                                        <strong>
                                                            Shop:{{$shop->shop->name}}
                                                        </strong>
                                                    </h5>
                                                </a>
                                                <ul>
                                                    <li><p>Address: {{$shop->shop->address}}</p></li>
                                                    <li><p>Post: {{$shop->shop->post}}</p></li>
                                                    <li><p>Phone: {{$shop->shop->tel}}</p></li>
                                                    <li><p>Email: {{$shop->shop->email}}</p></li>
                                                </ul>
                                                <button  name="addtocart" style="font-size: x-large" value="5" class="btn amado-btn btn-md btn-block"> 
                                                    <a style="font-size: x-large; color: white" href="{{route('shop.profile', $shop->shop)}}">Go to shop <i class="fa fa-home"></i></a> 
                                                </button>
                                            </div>
                                        </div>
                                    </div> 
                                @else
                                    <div class="carousel-item ">
                                        <div class="card" style="background-color: #3c3c3c; ;; color:white">
                                            <div class="card-body" style="color: #fbb710">
                                                <a href="">
                                                    <h5 class="mb-2" style="color: #fbb710"> 
                                                        <i class="fa fa-user pr-2" aria-hidden="true"></i> 
                                                        <strong>
                                                            Shop:{{$shop->shop->name}}
                                                        </strong>
                                                    </h5>
                                                </a>
                                                <ul>
                                                    <li><p>Address: {{$shop->shop->address}}</p></li>
                                                    <li><p>Post: {{$shop->shop->post}}</p></li>
                                                    <li><p>Phone: {{$shop->shop->tel}}</p></li>
                                                    <li><p>Email: {{$shop->shop->email}}</p></li>
                                                </ul>
                                                <button  name="addtocart" style="font-size: x-large" value="5" class="btn amado-btn btn-md btn-block"> 
                                                    <a style="font-size: x-large; color: white" href="{{route('shop.profile', $shop->shop)}}">Go to shop <i class="fa fa-home"></i></a> 
                                                </button>
                                            </div>
                                        </div>
                                    </div> 
                                @endif
                            
                            @endforeach

                            <a class="carousel-control-prev" href="#product_details_slider3" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#product_details_slider3" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>

                        </div>
                    </div>
                </div>
                @else
                    <div class="single_product_thumb d-flex flex-column">
                        <h2><strong>Shops</strong></h2>
                        <h5>
                            Bike is not available in any shop
                        </h5>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- stars script -->
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
