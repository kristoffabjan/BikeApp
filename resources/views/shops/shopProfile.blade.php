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
                        <p class="product-price">Bike shop</p> 
                        <div class="d-flex">
                            <div class="mr-auto">
                                <a href="#">
                                    <h6>{{$shop->name}}</h6>
                                </a>
                            </div>
                            @auth
                                @if ($shop->createdBy(Auth::user(), $shop))
                                <div class="d-flex ">
                                    <button  name="addtocart"  value="5" class="btn btn-dark btn-md mr-2"> 
                                        <a style=" color: white" class="h6" href="{{route('edit.shop', $shop)}}">Edit<i class="fa fa-edit ml-1"></i></a> 
                                    </button>

                                    <form action="{{route('delete.shop', $shop)}}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <input class="btn btn-dark btn-md mr-3" style="font-size: x-large" type="submit" value="Delete">
                                    </form>
                                </div>
                                @endif
                            @endauth
                        </div>
                        
                        <div class="d-flex">
                            <a href="{{route('profile.user', $shop->user)}}">
                                <p class="avaibility mr-3"><i class="fa fa-user mr-1 " aria-hidden="true"></i>{{$shop->user->name}}</p>
                            </a>
                            <span class="text-secondary text-sm pt-1" style="font-size: medium;"> {{$shop->created_at->diffForHumans()}}</span>
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
                        
                    </div>

                    

                    <div class="short_overview my-5 d-flex flex-column">
                        
                        <ul class="mt-4">
                            <li> <strong>Address: </strong> {{$shop->address}}</li>
                            <li> <strong>Post number: </strong> {{$shop->post}}</li>
                            <li><p><i class="fa fa-phone pr-2" aria-hidden="true"></i>{{$shop->tel}}</p></li>
                            <li> <strong>email: </strong> {{$shop->email}}</li>
                            <li> <strong><a href="{{$shop->url}}">URL</a></strong> </li>
                        </ul>
                    </div>

                    <!-- Add to Cart Form -->
                    @auth
                    <div class="d-flex flex-column">
                        <div class="d-flex flex-wrap">
                            <div class="d-flex justify-content-center align-items-center">
                                <form action="{{route('shopImages', $shop->id)}}" method="post" enctype="multipart/form-data">
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
                                @if ($shop->createdBy(Auth::user(), $shop))
                                    <h3>Add bikes to shop:</h3>
                                    <a class="btn btn-dark btn-lg " href="{{route('bikeToShop', $shop)}}"  role="button">Add</a>
                                @endif
                            </div>
                        </div>
                        <div>
                            @if (!$shop->createdBy(Auth::user(), $shop))
                                @if (!$shop->hasRated(Auth::user()))
                                    <button  name="addtocart" style="font-size: x-large" value="5" class="btn amado-btn btn-lg btn-block"> 
                                        <a style="font-size: x-large; color: white" href="{{route('rate.shop.open.form', $shop)}}">Rate Shop <i class="fa fa-star"></i>
                                        </a> 
                                        <!-- -->
                                    </button>
                                @endif
                            @endif
                        </div>
                    </div>
                    @endauth
                </div>
            </div>
        </div>
        
        <div class="row p-2 ml-2" style="border: 3px solid #fbb710; border-radius: 25px">
            <div class="col-12 col-md-8">
                <h2 class="mt-3"> {{ Str::plural('Bike', count($bikes_at_shop)) }} currently available at this shop:</h2>
                    @if ( count($bikes_at_shop) > 0)
                        <!-- singular and plural bikes-->
                        <h3><strong>{{count($bikes_at_shop)}} {{ Str::plural('bike', count($bikes_at_shop) )  }} </strong> currently available</h3>
                        @foreach ($bikes_at_shop as $bike)
                        <!-- $bike lists entries from bikeAtShop table, bike is a relation, that each bikeAtShop entry belongs to certain bike -->
                            <div class="d-flex mb-4 flex-wrap pl-2 border border-dark rounded p-2" style="background-color: #fbb710">
                                <div class="mr-2">
                                    <div class="user-avatar">
                                        <img class="img-thumbnail" style="max-width: 250px" src="{{$bike->bike->profile_image}}" alt="">
                                    </div>
                                </div>
                                <div class="d-flex flex-column">
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
                                <div class="ml-auto d-flex justify-content-center align-items-center mr-4">
                                    <button  name="addtocart" id="go_to_store"  value="5" class="btn amado-btn btn-lg mr-3"> 
                                        <a style="font-size: x-large; color:white " href="{{route('rate.bike', $bike->bike->id)}}">Go to bike <i class="fa fa-bicycle"></i></a> 
                                    </button>
                                    @auth
                                        @if ($shop->createdBy(Auth::user(), $shop))
                                            <form action="{{route('bikeToShop.destroy', [$shop,$bike->bike])}}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <input class="btn btn-dark btn-md mr-3" style="font-size: x-large" type="submit" value="Remove">
                                            </form>
                                        @endif
                                    @endauth
                                </div>
                            </div>
                        @endforeach
                    @else
                    <div class="d-flex mb-4 pl-2 ">
                        <h3><strong>0</strong> currently available bikes</h3>
                    </div>
                    @endif
            </div>

            
            <div class="col-12 col-md-4">
                @if ( $rates->count() > 0)
                    <div class="single_product_thumb d-flex flex-column mt-2">
                        <h2><strong> {{ Str::plural('Rating', count($rates)) }}: </strong></h2>
                        <div id="product_details_slider1" class="carousel slide" data-ride="carousel">
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
                                                                <div class="d-flex ">
                                                                    <button  name="addtocart"  value="5" class="btn btn-dark btn-md mr-2"> 
                                                                        <a style=" color: white" class="h6" href="{{route('edit.shop.rate', [$rate, $shop])}}">Edit<i class="fa fa-edit ml-1"></i></a> 
                                                                    </button>

                                                                    <form action="{{route('destroy.shop.rate', $rate)}}" method="POST">
                                                                        @method('DELETE')
                                                                        @csrf
                                                                        <input class="btn btn-dark btn-md mr-3" style="font-size: x-large" type="submit" value="Delete">
                                                                    </form>
                                                                </div>
                                                            @endif   
                                                        @endauth
                                                    </div>
                                                    
                                                    
                                                    <ul>
                                                        <li>
                                                            <h6 class="avaibility"><i class="fa fa-star pr-2" aria-hidden="true"></i>{{$rate->stars}}</h6>
                                                        </li>
                                                        <li>Opinion: {{$rate->opinion}} </li>
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
                                                                        <a style=" color: white" class="h6" href="{{route('edit.shop.rate', [$rate, $shop])}}">Edit<i class="fa fa-edit ml-1"></i></a> 
                                                                    </button>
                    
                                                                    <form action="{{route('destroy.shop.rate', $rate)}}" method="POST">
                                                                        @method('DELETE')
                                                                        @csrf
                                                                        <input class="btn btn-dark btn-md mr-3" style="font-size: x-large" type="submit" value="Delete">
                                                                    </form>
                                                                </div>
                                                            @endif   
                                                        @endauth
                                                    </div>
                                                    
                                                    
                                                    <ul>
                                                        <li>
                                                            <h6 class="avaibility"><i class="fa fa-star pr-2" aria-hidden="true"></i>{{$rate->stars}}</h6>
                                                        </li>
                                                        <li>Opinion: {{$rate->opinion}} </li>
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
            </div>
        </div>

    </div>
</div>

<!-- stars script -->
<script>
    document.getElementById("stars").innerHTML = getStars({{$stars}});

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
