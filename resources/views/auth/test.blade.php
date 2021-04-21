<div class="single-product-area section-padding-100 clearfix">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12 col-lg-7">
                <div class="single_product_thumb">
                    <div id="product_details_slider" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li class="active" data-target="#product_details_slider" data-slide-to="0" style="background-image: url(img/product-img/pro-big-1.jpg);">
                            </li>
                            <li data-target="#product_details_slider" data-slide-to="1" style="background-image: url(img/product-img/pro-big-2.jpg);">
                            </li>
                            <li data-target="#product_details_slider" data-slide-to="2" style="background-image: url(img/product-img/pro-big-3.jpg);">
                            </li>
                            <li data-target="#product_details_slider" data-slide-to="3" style="background-image: url(img/product-img/pro-big-4.jpg);">
                            </li>
                            <li data-target="#product_details_slider" data-slide-to="4" style="background-image: url(img/product-img/pro-big-4.jpg);">
                            </li>
                            <li data-target="#product_details_slider" data-slide-to="5" style="background-image: url(img/product-img/pro-big-4.jpg);">
                            </li>
                            <li data-target="#product_details_slider" data-slide-to="6" style="background-image: url(img/product-img/pro-big-4.jpg);">
                            </li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <a class="gallery_img" href="img/product-img/pro-big-1.jpg">
                                    <img class="d-block w-100" src="img/product-img/pro-big-1.jpg" alt="First slide">
                                </a>
                            </div>
                            <div class="carousel-item">
                                <a class="gallery_img" href="img/product-img/pro-big-2.jpg">
                                    <img class="d-block w-100" src="img/product-img/pro-big-2.jpg" alt="Second slide">
                                </a>
                            </div>
                            <div class="carousel-item">
                                <a class="gallery_img" href="img/product-img/pro-big-3.jpg">
                                    <img class="d-block w-100" src="img/product-img/pro-big-3.jpg" alt="Third slide">
                                </a>
                            </div>
                            <div class="carousel-item">
                                <a class="gallery_img" href="img/product-img/pro-big-4.jpg">
                                    <img class="d-block w-100" src="img/product-img/pro-big-4.jpg" alt="Fourth slide">
                                </a>
                            </div>

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