@extends('layouts.index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="container">
            <div class="row gutters">
            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
            <div class="card h-70">
                <div class="card-body">
                    <div class="account-settings">
                        <div class="user-profile">
                            <div class="user-avatar">
                                <p>image to be</p>
                            </div>
                            <h3>{{$bike->brand}}</h3>
                        </div>
                        <div class="about">
                            <h4>{{$bike->model}}</h4>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
            <div class="card h-70">
                <div class="card-body">
                    <ul>
                        <li><strong> Released:</strong> {{$bike->release_date}}</li>
                        <li><strong> Price:</strong> {{$bike->price}}</li>
                        <li><strong> Frame suspension: </strong>{{$bike->suspension_range}}</li>
                        <li><strong> URL:</strong> <a href="{{$bike->url}}">link to official page</a></li>
                    </ul>
                </div>
            </div>
            </div>
            </div>
            </div>
    </div>
    
</div>
@endsection
