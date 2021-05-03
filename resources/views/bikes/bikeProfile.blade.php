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
                                    <button  name="addtocart" href="{{route('new.test', $bike->id)}}"  value="5" class="btn amado-btn mr-1">Add official test</button>
                                </th>
                              </tr>
                            </thead>
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
        <div class="row mb-3">

        </div>
        <div class="row mb-3 ">
            <div class="col">
                @auth
                @if (!$bike->createdBy(Auth::user(), $bike))
                    @if (!$bike->hasRated(Auth::user()))
                    <div class="" id="">
                        <h2 class="mb-2">Rate this bike:</h2>
                        <div class="card p-4">
                            <form action="{{route('rate.bike.form', $bike->id)}}" method="post">
                                @csrf
                                <div class="form-group row mb-2 pr-3 pl-3">
                                    <div class=" d-flex mr-2 mb-1">
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
                                    <div class="d-flex mb-1">
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
                                    <div class=" d-flex mb-1 ">
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
                                    <div class=" d-flex mb-1">
                                        <label for="brand" class="mr-1 pt-2">Descend: </label>
                                        <select class="form-select " name="descend" aria-label="Default select example" required>
                                            <option selected>Open </option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                    <div class=" d-flex mb-1">
                                        <label for="brand" class="mr-1 pt-2 ">Agility: </label>
                                        <select class="form-select ml-4 " name="agility" aria-label="Default select example" required>
                                            <option selected>Open </option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
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
        <div class="row mt-3">
            <div class="col">
                <div class="container">
                    <div class="row">
                        <h2>Carousel Reviews</h2>
                    </div>
                </div>
                <div class="carousel-reviews broun-block">
                    <div class="container">
                        <div class="row">
                            <div id="carousel-reviews" class="carousel slide" data-ride="carousel">
                            
                                <div class="carousel-inner">
                                    <div class="item active">
                                        <div class="col-md-4 col-sm-6">
                                            <div class="block-text rel zmin">
                                                <a title="" href="#">Hercules</a>
                                                <div class="mark">My rating: <span class="rating-input"><span data-value="0" class="glyphicon glyphicon-star"></span><span data-value="1" class="glyphicon glyphicon-star"></span><span data-value="2" class="glyphicon glyphicon-star"></span><span data-value="3" class="glyphicon glyphicon-star"></span><span data-value="4" class="glyphicon glyphicon-star-empty"></span><span data-value="5" class="glyphicon glyphicon-star-empty"></span>  </span></div>
                                                <p>Never before has there been a good film portrayal of ancient Greece's favourite myth. So why would Hollywood start now? This latest attempt at bringing the son of Zeus to the big screen is brought to us by X-Men: The last Stand director Brett Ratner. If the name of the director wasn't enough to dissuade ...</p>
                                                <ins class="ab zmin sprite sprite-i-triangle block"></ins>
                                            </div>
                                            <div class="person-text rel">
                                                <a title="" href="#">Anna</a>
                                                <i>from Glasgow, Scotland</i>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6 hidden-xs">
                                            <div class="block-text rel zmin">
                                                <a title="" href="#">The Purge: Anarchy</a>
                                                <div class="mark">My rating: <span class="rating-input"><span data-value="0" class="glyphicon glyphicon-star"></span><span data-value="1" class="glyphicon glyphicon-star"></span><span data-value="2" class="glyphicon glyphicon-star-empty"></span><span data-value="3" class="glyphicon glyphicon-star-empty"></span><span data-value="4" class="glyphicon glyphicon-star-empty"></span><span data-value="5" class="glyphicon glyphicon-star-empty"></span>  </span></div>
                                                <p>The 2013 movie "The Purge" left a bad taste in all of our mouths as nothing more than a pseudo-slasher with a hamfisted plot, poor pacing, and a desperate attempt at "horror." Upon seeing the first trailer for "The Purge: Anarchy," my first and most immediate thought was "we really don't need another one of these."  </p>
                                                <ins class="ab zmin sprite sprite-i-triangle block"></ins>
                                            </div>
                                            <div class="person-text rel">
                                                
                                                <a title="" href="#">Ella Mentree</a>
                                                <i>United States</i>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6 hidden-sm hidden-xs">
                                            <div class="block-text rel zmin">
                                                <a title="" href="#">Planes: Fire & Rescue</a>
                                                <div class="mark">My rating: <span class="rating-input"><span data-value="0" class="glyphicon glyphicon-star"></span><span data-value="1" class="glyphicon glyphicon-star"></span><span data-value="2" class="glyphicon glyphicon-star"></span><span data-value="3" class="glyphicon glyphicon-star"></span><span data-value="4" class="glyphicon glyphicon-star"></span><span data-value="5" class="glyphicon glyphicon-star"></span>  </span></div>
                                                <p>What a funny and entertaining film! I did not know what to expect, this is the fourth film in this vehicle's universe with the two Cars movies and then the first Planes movie. I was wondering if maybe Disney pushed it a little bit. However, Planes: Fire and Rescue is an entertaining film that is a fantastic sequel in this magical franchise. </p>
                                                <ins class="ab zmin sprite sprite-i-triangle block"></ins>
                                            </div>
                                            <div class="person-text rel">
                                                <a title="" href="#">Rannynm</a>
                                                <i>Indonesia</i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="col-md-4 col-sm-6">
                                            <div class="block-text rel zmin">
                                                <a title="" href="#">Hercules</a>
                                                <div class="mark">My rating: <span class="rating-input"><span data-value="0" class="glyphicon glyphicon-star"></span><span data-value="1" class="glyphicon glyphicon-star"></span><span data-value="2" class="glyphicon glyphicon-star"></span><span data-value="3" class="glyphicon glyphicon-star"></span><span data-value="4" class="glyphicon glyphicon-star-empty"></span><span data-value="5" class="glyphicon glyphicon-star-empty"></span>  </span></div>
                                                <p>Never before has there been a good film portrayal of ancient Greece's favourite myth. So why would Hollywood start now? This latest attempt at bringing the son of Zeus to the big screen is brought to us by X-Men: The last Stand director Brett Ratner. If the name of the director wasn't enough to dissuade ...</p>
                                                <ins class="ab zmin sprite sprite-i-triangle block"></ins>
                                            </div>
                                            <div class="person-text rel">
                                                <img alt="" src="http://myinstantcms.ru/images/img13.png">
                                                <a title="" href="#">Anna</a>
                                                <i>from Glasgow, Scotland</i>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6 hidden-xs">
                                            <div class="block-text rel zmin">
                                                <a title="" href="#">The Purge: Anarchy</a>
                                                <div class="mark">My rating: <span class="rating-input"><span data-value="0" class="glyphicon glyphicon-star"></span><span data-value="1" class="glyphicon glyphicon-star"></span><span data-value="2" class="glyphicon glyphicon-star-empty"></span><span data-value="3" class="glyphicon glyphicon-star-empty"></span><span data-value="4" class="glyphicon glyphicon-star-empty"></span><span data-value="5" class="glyphicon glyphicon-star-empty"></span>  </span></div>
                                                <p>The 2013 movie "The Purge" left a bad taste in all of our mouths as nothing more than a pseudo-slasher with a hamfisted plot, poor pacing, and a desperate attempt at "horror." Upon seeing the first trailer for "The Purge: Anarchy," my first and most immediate thought was "we really don't need another one of these."  </p>
                                                <ins class="ab zmin sprite sprite-i-triangle block"></ins>
                                            </div>
                                            <div class="person-text rel">
                                                <img alt="" src="http://myinstantcms.ru/images/img14.png">
                                                <a title="" href="#">Ella Mentree</a>
                                                <i>United States</i>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6 hidden-sm hidden-xs">
                                            <div class="block-text rel zmin">
                                                <a title="" href="#">Planes: Fire & Rescue</a>
                                                <div class="mark">My rating: <span class="rating-input"><span data-value="0" class="glyphicon glyphicon-star"></span><span data-value="1" class="glyphicon glyphicon-star"></span><span data-value="2" class="glyphicon glyphicon-star"></span><span data-value="3" class="glyphicon glyphicon-star"></span><span data-value="4" class="glyphicon glyphicon-star"></span><span data-value="5" class="glyphicon glyphicon-star"></span>  </span></div>
                                                <p>What a funny and entertaining film! I did not know what to expect, this is the fourth film in this vehicle's universe with the two Cars movies and then the first Planes movie. I was wondering if maybe Disney pushed it a little bit. However, Planes: Fire and Rescue is an entertaining film that is a fantastic sequel in this magical franchise. </p>
                                                <ins class="ab zmin sprite sprite-i-triangle block"></ins>
                                            </div>
                                            <div class="person-text rel">
                                                <img alt="" src="http://myinstantcms.ru/images/img15.png">
                                                <a title="" href="#">Rannynm</a>
                                                <i>Indonesia</i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="col-md-4 col-sm-6">
                                            <div class="block-text rel zmin">
                                                <a title="" href="#">Hercules</a>
                                                <div class="mark">My rating: <span class="rating-input"><span data-value="0" class="glyphicon glyphicon-star"></span><span data-value="1" class="glyphicon glyphicon-star"></span><span data-value="2" class="glyphicon glyphicon-star"></span><span data-value="3" class="glyphicon glyphicon-star"></span><span data-value="4" class="glyphicon glyphicon-star-empty"></span><span data-value="5" class="glyphicon glyphicon-star-empty"></span>  </span></div>
                                                <p>Never before has there been a good film portrayal of ancient Greece's favourite myth. So why would Hollywood start now? This latest attempt at bringing the son of Zeus to the big screen is brought to us by X-Men: The last Stand director Brett Ratner. If the name of the director wasn't enough to dissuade ...</p>
                                                <ins class="ab zmin sprite sprite-i-triangle block"></ins>
                                            </div>
                                            <div class="person-text rel">
                                                <img alt="" src="http://myinstantcms.ru/images/img13.png">
                                                <a title="" href="#">Anna</a>
                                                <i>from Glasgow, Scotland</i>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6 hidden-xs">
                                            <div class="block-text rel zmin">
                                                <a title="" href="#">The Purge: Anarchy</a>
                                                <div class="mark">My rating: <span class="rating-input"><span data-value="0" class="glyphicon glyphicon-star"></span><span data-value="1" class="glyphicon glyphicon-star"></span><span data-value="2" class="glyphicon glyphicon-star-empty"></span><span data-value="3" class="glyphicon glyphicon-star-empty"></span><span data-value="4" class="glyphicon glyphicon-star-empty"></span><span data-value="5" class="glyphicon glyphicon-star-empty"></span>  </span></div>
                                                <p>The 2013 movie "The Purge" left a bad taste in all of our mouths as nothing more than a pseudo-slasher with a hamfisted plot, poor pacing, and a desperate attempt at "horror." Upon seeing the first trailer for "The Purge: Anarchy," my first and most immediate thought was "we really don't need another one of these."  </p>
                                                <ins class="ab zmin sprite sprite-i-triangle block"></ins>
                                            </div>
                                            <div class="person-text rel">
                                                <img alt="" src="http://myinstantcms.ru/images/img14.png">
                                                <a title="" href="#">Ella Mentree</a>
                                                <i>United States</i>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6 hidden-sm hidden-xs">
                                            <div class="block-text rel zmin">
                                                <a title="" href="#">Planes: Fire & Rescue</a>
                                                <div class="mark">My rating: <span class="rating-input"><span data-value="0" class="glyphicon glyphicon-star"></span><span data-value="1" class="glyphicon glyphicon-star"></span><span data-value="2" class="glyphicon glyphicon-star"></span><span data-value="3" class="glyphicon glyphicon-star"></span><span data-value="4" class="glyphicon glyphicon-star"></span><span data-value="5" class="glyphicon glyphicon-star"></span>  </span></div>
                                                <p>What a funny and entertaining film! I did not know what to expect, this is the fourth film in this vehicle's universe with the two Cars movies and then the first Planes movie. I was wondering if maybe Disney pushed it a little bit. However, Planes: Fire and Rescue is an entertaining film that is a fantastic sequel in this magical franchise. </p>
                                                <ins class="ab zmin sprite sprite-i-triangle block"></ins>
                                            </div>
                                            <div class="person-text rel">
                                                <img alt="" src="http://myinstantcms.ru/images/img15.png">
                                                <a title="" href="#">Rannynm</a>
                                                <i>Indonesia</i>
                                            </div>
                                        </div>
                                    </div>                    
                                </div>
                                <a class="left carousel-control" href="#carousel-reviews" role="button" data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left"></span>
                                </a>
                                <a class="right carousel-control" href="#carousel-reviews" role="button" data-slide="next">
                                    <span class="glyphicon glyphicon-chevron-right"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
