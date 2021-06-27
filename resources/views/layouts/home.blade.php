@extends('layouts.index')

@section('content')
<div class="products-catagories-area clearfix">
    <div class="amado-pro-catagory clearfix">

        <div class="d-flex align-content-start flex-wrap">
            @foreach ($bikes as $bike)
                <div class="single-products-catagory clearfix">
                    <a href="{{route('rate.bike', $bike->id)}}">
                        <img src="/bikes_profile_images/{{$bike->profile_image}}" alt="">
                        <!-- Hover Content -->
                        <div class="hover-content">
                            <div class="line"></div>
                            <p>From {{$bike->price}}€</p>
                            <h4>{{$bike->brand}} {{$bike->model}}</h4>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        
    </div>
</div>


 
@endsection
