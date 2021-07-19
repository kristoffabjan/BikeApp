@extends('layouts.index')

@section('content')
<div class="single-product-area section-padding-100 clearfix">
    <div class="container-fluid">

        <div class="row mb-3">
            <div class="col-12 col-lg-7">   
                <div class="single_product_thumb">
                    <div id="product_details_slider" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">

                            @foreach ($images as $image)
                                @if ($image == $images[0])
                                    <div class="carousel-item active">
                                        <a class="gallery_img" href="{{$image->path}}">
                                            <img class="d-block w-100" src="{{$image->path}}" alt="First slide">
                                        </a>
                                    </div> 
                                @else
                                <div class="carousel-item ">
                                    <a class="gallery_img" href="{{$image->path}}">
                                        <img class="d-block w-100" src="{{$image->path}}" alt="Non-first slide">
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
                        <p class="product-price">from {{$bike->price}}€</p>
                        <a href="product-details.html">
                            <h6>{{$bike->brand}} {{$bike->model}} </h6>
                        </a>
                        <!-- Ratings & Review -->
                        <div class="ratings-review mb-15 d-flex align-items-center justify-content-between">
                            <div class="ratings">
                                <div class="about d-flex">
                                    <b class="mr-2 mt-1"><span id=stars></span></b>
                                </div>
                            </div>
                            @auth
                                @if ($bike->createdBy(Auth::user(), $bike))
                                    <div class="review">
                                        <a href="{{route('edit.bike', $bike)}}" class="text-success">Edit</a>
                                        <a href="{{route('delete.bike', $bike)}}" class="text-danger">Delete</a>
                                    </div>
                                @endif
                            @endauth
                        </div>
                        <!-- Avaiable -->
                        <a href="{{route('profile.user', $bike->user)}}">
                        <p class="avaibility"><i class="fa fa-user pr-2" aria-hidden="true"></i>{{$bike->user->name}}</p></a>
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

                    <!-- Add to Cart Form -->
                        

                        <table class="table">
                            @auth
                                <thead>
                                <tr>
                                    <th scope="col">
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
                                    </th>
                                    <th scope="col">
                                        <button  name="addtocart"  class="btn amado-btn mr-1"><a style="font-size: x-large; color: white" href="{{route('new.test.form', $bike)}}">Add review</a></button>
                                    </th>
                                </tr>
                                </thead>
                            @endauth
                            <tbody>
                                @auth
                                    @if (!$bike->createdBy(Auth::user(), $bike))
                                        @if (!$bike->hasRated(Auth::user()))
                                            <tr>
                                                <td colspan="2">
                                                    <button  name="addtocart" style="font-size: x-large" value="5" class="btn amado-btn btn-lg btn-block"> 
                                                        <a style="font-size: x-large; color: white" href="{{route('rate.bike.open.form', $bike)}}">Rate bike <i class="fa fa-star"></i></a> 
                                                    </button>
                                                </td>
                                            </tr>
                                        @endif
                                    @endif
                                @endauth
                            </tbody>
                          </table>

                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col">
                <div class="container">
                    <div class="row">
                        <div class="d-flex justify-content-center">

                            @if ( $tests->count() > 0 )
                            <div class="mr-3 d-flex flex-column">
                                <h2><strong>Reviews:</strong></h2>
                                <div id="product_details_slider2" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
            
                                        @foreach ($tests as $test)
                                            @if ($test == $tests[0])
                                                <div class="carousel-item active">
                                                    <div class="card" style="background-color: #fbb710; width: 20rem; height:25rem;color:white">
                                                        <div class="card-body">
                                                            <a href="{{route('profile.user', $bike->user)}}">
                                                                <h5 class="avaibility"><i class="fa fa-user pr-2" aria-hidden="true"></i>{{$bike->user->name}}</h5></a>
                                                        <ul>
                                                            <li><p>Article: {{$test->name}}</p></li>
                                                            <button class="btn btn-secondary"> <a href="{{$test->url}}">URL</a></button>
                                                        </ul>
                                                        </div>
                                                    </div>
                                                </div> 
                                            @else
                                                <div class="carousel-item ">
                                                    <div class="card" style="background-color: #fbb710; width: 20rem;height:25rem; color:white">
                                                        <div class="card-body">
                                                            <a href="{{route('profile.user', $bike->user)}}">
                                                                <h5 class="avaibility"><i class="fa fa-user pr-2" aria-hidden="true"></i>{{$bike->user->name}}</h5></a>
                                                        <ul>
                                                            <li><p>Article: {{$test->name}}</p></li>
                                                            <li><a href="{{$test->url}}">URL</a></li>
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

                            @if ( $rates->count() > 0 )
                            <div class="single_product_thumb d-flex flex-column mr-3">
                                <h2><strong>Ratings:</strong></h2>
                                <div id="product_details_slider1" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
            
                                        @foreach ($rates as $rate)
                                            @if ($rate == $rates[0])
                                                <div class="carousel-item active">
                                                    <div class="card" style="background-color: #fbb710; width: 20rem;height:25rem; color:white">
                                                        <div class="card-body">
                                                            <a href="{{route('profile.user', $rate->user)}}">
                                                                <h5 class="avaibility"><i class="fa fa-user pr-2" aria-hidden="true"></i>{{$rate->user->name}}</h5></a>
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
                                            @else
                                                <div class="carousel-item ">
                                                    <div class="card" style="background-color: #fbb710; height:25rem;width: 20rem">
                                                        <div class="card-body">
                                                            <a href="{{route('profile.user', $rate->user)}}">
                                                                <h5 class="avaibility"><i class="fa fa-user pr-2" aria-hidden="true"></i>{{$rate->user->name}}</h5></a>
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
                                <div class="single_product_thumb d-flex flex-column">
                                    <h2><strong>Rates:</strong></h2>
                                    <h5>
                                        No rates yet
                                    </h5>
                                </div>
                            @endif

                            @if ( $shops->count() > 0)
                                <div class="single_product_thumb d-flex flex-column">
                                    <h2><strong>Available at:</strong></h2>
                                    <div id="product_details_slider3" class="carousel slide" data-ride="carousel">
                                        <div class="carousel-inner">
                
                                            @foreach ($shops as $shop)
                                                @if ($shop == $shops[0])
                                                    <div class="carousel-item active">
                                                        <div class="card" style="background-color: #3c3c3c; width: 20rem;height:25rem; color:white">
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
                                                        <div class="card" style="background-color: #3c3c3c; width: 20rem;height:25rem; color:white">
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
