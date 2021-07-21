@extends('layouts.index')

@section('content')
<!-- ##### Main Content Wrapper Start ##### -->
<div class="shop_sidebar_area">

    <!-- ##### Single Widget ##### -->
    

    <form action="{{route('sort.bikes.attributes')}}" method="post" id="main_filter">
        @csrf
        <!-- ##### Single Widget ##### -->
        <div class="widget brands mb-50">
            <!-- Widget Title -->
            <h6 class="widget-title mb-10">Brands:</h6>

            <div class="widget-desc">
                <!-- Single Form Check -->
                @foreach ($brands as $brand)
                    
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="{{$brand->brand}}" id="{{$brand->brand}}" name="{{$brand->id}}">
                        <label class="form-check-label" for="amado">{{$brand->brand}}</label>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- ##### Single Widget ##### -->
        <div class="widget price mb-30 ">
            <!-- Widget Title -->
            <h6 class=" mb-1">Suspension(mm):</h6>
            <div class="range-price">From...</div>
            <div class="widget-desc">
                <div class="">
                    <div class="d-flex justify-content-center mb-1 ">
                        <input id="slider10" class="border-0 " type="range" min="50" max="215" name="from_sus" value="100"/>
                      <span class="font-weight-bold text-primary ml-3 mt-1 valueSpan"></span>
                    </div>
                    <div class="range-price mb-1 mt-1">to</div>
                    <div class="d-flex justify-content-center my-1 ">
                        <input id="slider11" class="border-0 " type="range" min="50" max="215" name="to_sus" value="180"/>
                      <span class="font-weight-bold text-primary ml-3 mt-1 valueSpan1"></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="widget price mb-30">
            <!-- Widget Title -->
            <h6 class=" mb-1">Price(€):</h6>
            <div class="range-price">From...</div>
            <div class="widget-desc">
                <div class="">
                    <div class="d-flex justify-content-center mb-1 ">
                        <input id="slider12" class="border-0 " type="range" min="800" max="15000" name="from_price" value="1000" />
                      <span class="font-weight-bold text-primary ml-3 mt-1 valueSpan2"></span>
                    </div>
                    <div class="range-price mb-1 mt-1">to</div>
                    <div class="d-flex justify-content-center my-1 ">
                        <input id="slider13" class="border-0 " type="range" min="800" max="15000" name="to_price"   value="10000"/>
                      <span class="font-weight-bold text-primary ml-3 mt-1 valueSpan3"></span>
                    </div>
                </div>
            </div>
        </div>

        

        <!-- ##### Single Widget ##### LEAVE IT FOR LATER 
        <div class="widget price mb-50">
            <!-- Widget Title 
            <h6 class="widget-title mb-30">Price:</h6>

            <div class="widget-desc">
                <div class="slider-range">
                    <div data-min="800" data-max="15000" data-unit="€" class="slider-range-price ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" data-value-min="800" data-value-max="15000" data-label-result="">
                        <div class="ui-slider-range ui-widget-header ui-corner-all"></div>
                        <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                        <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                    </div>
                    <div class="range-price">800€ - 15000€</div>
                </div>
            </div>
        </div>
        -->

        <div class="widget">
            <button  name="addtocart" style="font-size: large"  class="btn amado-btn btn-md"> 
                <a style="font-size: large; color: white"  onclick="main_filter()" href="#">Filter <i class="fa fa-filter"></i></a> 
            </button>
        </div>
    </form>

</div>

<div class="amado_product_area section-padding-100">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="product-topbar d-xl-flex align-items-end justify-content-between">
                    <!-- Total Products -->
                    <!--
                    <div class="total-products">
                        <p>Showing 1-8 0f 25</p>
                        <div class="view d-flex">
                            <a href="#"><i class="fa fa-th-large" aria-hidden="true"></i></a>
                            <a href="#"><i class="fa fa-bars" aria-hidden="true"></i></a>
                        </div>
                    </div>   -->
                    <!-- Sorting -->
                    <div class="product-sorting d-flex">
                        <div class="sort-by-date d-flex align-items-center mr-15">
                            <p>Sort by</p>
                            <form action="{{route('sort.bikes')}}" method="post" id="sort_form">
                                @csrf
                                <select name="sort" id="sortBydate" onchange="submit_sort()">
                                    <option  value="new">New</option>
                                    <option  value="old">Old</option>
                                    <option  value="top">Top </option>
                                    <option  value="expensive">Expensive</option>
                                    <option  value="cheap">Cheapest</option>
                                </select>
                            </form>
                        </div>
                        <div class="view-product d-flex align-items-center">
                            <p>View</p>
                            <form action="#" method="get">
                                <select name="select" id="viewProduct">
                                    <option value="value">12</option>
                                    <option value="value">24</option>
                                    <option value="value">48</option>
                                    <option value="value">96</option>
                                </select>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="products-catagories-area clearfix">
                <div class="amado-pro-catagory clearfix">

                    <div class="d-flex align-content-start flex-wrap">
                        @if ($bikes->count() > 0)
                            @foreach ($bikes as $bike)
                                <div class="single-products-catagory clearfix">
                                    <a href="{{route('rate.bike', $bike->id)}}">
                                        
                                        <img src="{{$bike->profile_image}}" alt="">
                                        <!-- Hover Content -->
                                        <div class="hover-content">
                                            <div class="line"></div>
                                            <p>From {{$bike->price}}€</p>
                                            <h4>{{$bike->brand}} {{$bike->model}}</h4>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        @else
                            <h2 class="ml-3">There are no bikes that match your criteria</h2>
                        @endif
                    </div>
                    
                </div>
            </div>
        </div>

        
        <!--
        <div class="row mt-30">
            <div class="col-12 ">
                <!-- Pagination 
                <nav aria-label="navigation">
                    <ul class="pagination justify-content-end mt-50">
                        <li class="page-item active"><a class="page-link" href="#">01.</a></li>
                        <li class="page-item"><a class="page-link" href="#">02.</a></li>
                        <li class="page-item"><a class="page-link" href="#">03.</a></li>
                        <li class="page-item"><a class="page-link" href="#">04.</a></li>
                    </ul>
                </nav>
                
            </div>
        </div>
        -->
    </div>
</div>
    
    <!-- ##### Main Content Wrapper End ##### -->
<!-- ##### jQuery (Necessary for All JavaScript Plugins) ##### -->
<script src="js/jquery/jquery-2.2.4.min.js"></script>
<!-- Popper js -->
<script src="js/popper.min.js"></script>
<!-- Bootstrap js -->
<script src="js/bootstrap.min.js"></script>
<!-- Plugins js -->
<script src="js/plugins.js"></script>
<!-- Active js -->
<script src="js/active.js"></script>
<script>
    function submit_sort() {
        document.getElementById("sort_form").submit();
    }

    function main_filter() {
        document.getElementById('main_filter').submit();
    }

    //slider
    $(document).ready(function() {

    const $valueSpan = $('.valueSpan');
    const $value = $('#slider10');
    $valueSpan.html($value.val());
    $value.on('input change', () => {

    $valueSpan.html($value.val());
    });
    });

    $(document).ready(function() {

    const $valueSpan = $('.valueSpan1');
    const $value = $('#slider11');
    $valueSpan.html($value.val());
    $value.on('input change', () => {

    $valueSpan.html($value.val());
    });
    });

    $(document).ready(function() {

    const $valueSpan = $('.valueSpan2');
    const $value = $('#slider12');
    $valueSpan.html($value.val());
    $value.on('input change', () => {

    $valueSpan.html($value.val());
    });
    });

    $(document).ready(function() {

    const $valueSpan = $('.valueSpan3');
    const $value = $('#slider13');
    $valueSpan.html($value.val());
    $value.on('input change', () => {

    $valueSpan.html($value.val());
    });
    });


    //slider end
</script>



 
@endsection
