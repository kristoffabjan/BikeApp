@extends('layouts.index')

@section('content')
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
                                        <a href="{{route('edit.bike', $bike)}}">Edit</a>
                                        <a href="{{route('delete.bike', $bike)}}">Delete</a>
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
                        <div class="cart-btn d-flex justify-content-around mb-50">
                            <div class="quantity">
                                <form action="{{route('bikeImages', $bike->id)}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group ">
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

                            <button  name="addtocart" href="{{route('new.test', $bike->id)}}"  value="5" class="btn amado-btn mr-1">Add official test</button>
                            <button  name="addtocart" value="5" class="btn amado-btn">Add </button>
                        </div>
                </div>
            </div>
        </div>
        <div class="row">
            @auth
                @if (!$bike->createdBy(Auth::user(), $bike))
                    @if (!$bike->hasRated(Auth::user()))
                    <div class="" id="">
                        <h2 class="mb-2">Rate this bike:</h2>
                        <div class="card p-3">
                            <form action="{{route('rate.bike.form', $bike->id)}}" method="post">
                                @csrf
                                <div class="form-group row mb-1">
                                    <div class="col-auto d-flex mr-2 ">
                                        <label for="brand" class="mr-1 pt-2">Overal rate: </label>
                                        <select class="form-select " name="overal" aria-label="Default select example" required>
                                            <option selected>Open </option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                    <div class="col-auto d-flex mr-2">
                                        <label for="brand" class="mr-1 pt-2">Price/performance: </label>
                                        <select class="form-select" name="pp" aria-label="Default select example" required>
                                            <option selected>Open </option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                    <div class="col-auto d-flex">
                                        <label for="brand" class="mr-1 pt-2">Ascend: </label>
                                        <select class="form-select " name="ascend" aria-label="Default select example" required>
                                            <option selected>Open </option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                </div>  

                                <div class="form-group row mb-1">
                                    <div class="col-auto d-flex mr-2">
                                        <label for="brand" class="mr-1 pt-2">Descend: </label>
                                        <select class="form-select " name="descend" aria-label="Default select example" required>
                                            <option selected>Open </option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select></div>
                                    <div class="col-auto d-flex">
                                        <label for="brand" class="mr-1 pt-2 bold">Agility: </label>
                                        <select class="form-select ml-4 " name="agility" aria-label="Default select example" required>
                                            <option selected>Open </option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                </div> 

                                <div class="form-group row p-2">
                                    <div class="form-row d-flex">
                                        <label for="exampleFormControlTextarea1">Users opinion</label>
                                        <textarea class="form-control mb-1" id="uo" name="opinion" rows="4"></textarea>
                                        <div class="col-sm-10">
                                            <button type="submit" class="btn btn-primary btn-dark">Submit rate</button>
                                        </div>
                                    </div>
                                </div> 
                            </form>
                        </div>
                    </div>
                    @endif
                @endif
            @endauth
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
