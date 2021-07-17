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
                        <p class="product-price">Bike shop</p> 
                        <a href="product-details.html">
                            <h6>{{$shop->name}}</h6>
                        </a>
                        <a href="{{route('profile.user', $shop->user)}}">
                            <p class="avaibility"><i class="fa fa-user pr-2" aria-hidden="true"></i>{{$shop->user->name}}</p></a>
                        <!-- Ratings & Review -->
                        <div class="ratings-review mb-15 d-flex align-items-center justify-content-between">
                            <div class="ratings">
                                <div class="about d-flex">
                                    <b class="mr-2 mt-1"><span id=stars></span></b>
                                </div>
                            </div>
                            @auth
                                @if ($shop->createdBy(Auth::user(), $shop))
                                    <div class="review">
                                        <a href="{{route('edit.shop', $shop)}}" class="text-success">Edit</a>
                                        <a href="{{route('delete.shop', $shop)}}" class="text-danger">Delete</a>
                                    </div>
                                @endif
                            @endauth
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
                        

                        <table class="table">
                            @auth
                                <thead>
                                <tr>
                                    <th scope="col">
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
                                    </th>
                                    <th scope="col">
                                        <h3>Add bikes to shop:</h3>
                                        <a class="btn btn-dark btn-lg " href="{{route('bikeToShop', $shop)}}"  role="button">Add</a>
                                    </th>
                                </tr>
                                </thead>
                            @endauth    
                            <tbody>
                                @auth
                                    @if (!$shop->createdBy(Auth::user(), $shop))
                                        @if (!$shop->hasRated(Auth::user()))
                                            <tr>
                                                <td colspan="2">
                                                    <button  name="addtocart" style="font-size: x-large" value="5" class="btn amado-btn btn-lg btn-block"> 
                                                        <a style="font-size: x-large; color: white" href="{{route('rate.shop.open.form', $shop)}}">Rate Shop <i class="fa fa-star"></i></a> 
                                                        <!-- -->
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
        
        <div class="row p-2" style="border: 3px solid #fbb710; border-radius: 25px">
            <div class="col-12 col-md-8">
                <h2 class="mt-3">Bikes currently available at this shop:</h2>
                @foreach ($bikes_at_shop as $bike)
                    <!-- $bike lists entries from bikeAtShop table, bike is a relation, that each bikeAtShop entry belongs to certain bike -->
                    <div class="d-flex mb-4 pl-2 border border-dark rounded">
                            <div class="mr-3">
                                <div class="user-avatar">
                                    <img class="img-thumbnail" style="max-width: 250px" src="/storage/bikes_profile_images/{{$bike->bike->profile_image}}" alt="">
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
                                    <a class="btn btn-dark btn-lg " style="background-color:#fbb710 " href="{{route('bikeToShop.destroy', [$shop,$bike->bike])}}"  role="button">
                                        Remove</a>
                                </div>
                            @endif
                            @endauth
                        </div>
                @endforeach
            </div>
            <div class="col-12 col-md-4">
                <div class="mr-3 d-flex flex-column">
                    <h2><strong>Reviews</strong></h2>
                    <div id="product_details_slider2" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">

                            @foreach ($rates as $rate)
                                @if ($rate == $rates[0])
                                    <div class="carousel-item active">
                                        <div class="card" style="background-color: #fbb710; width: 20rem; height:25rem;color:white">
                                            <div class="card-body">
                                                <a href="{{route('profile.user', $rate->user)}}">
                                                    <p class="avaibility"><i class="fa fa-user pr-2" aria-hidden="true"></i>{{$rate->user->name}}</p></a>
                                                <ul>
                                                    <li>
                                                        <p class="avaibility"><i class="fa fa-star pr-2" aria-hidden="true"></i>{{$rate->stars}}</p>
                                                    </li>
                                                    <li>Opinion: {{$rate->opinion}} </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div> 
                                @else
                                    <div class="carousel-item ">
                                        <div class="card" style="background-color: #fbb710; width: 20rem; height:25rem;color:white">
                                            <div class="card-body">
                                                <a href="{{route('profile.user', $rate->user)}}">
                                                    <p class="avaibility"><i class="fa fa-user pr-2" aria-hidden="true"></i>{{$rate->user->name}}</p></a>
                                                <ul>
                                                    <li>
                                                        <p class="avaibility"><i class="fa fa-star pr-2" aria-hidden="true"></i>{{$rate->stars}}</p>
                                                    </li>
                                                    <li>Opinion: {{$rate->opinion}} </li>
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
