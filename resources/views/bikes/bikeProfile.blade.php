@extends('layouts.index')

@section('content')
<div class="container d-flex-column">
        <div class="container pb-4">
            <div class="row gutters">
            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
            <div class="card h-70">
                <div class="card-body">
                    <div class="account-settings">
                        <div class="user-profile">
                            <div class="user-avatar">
                                <img class="img-fluid" src="/storage/bikes_profile_images/{{$bike->profile_image}}" alt="">
                            </div>
                            <h3>{{$bike->brand}}</h3>
                        </div>
                        <div class="about">
                            <h4>{{$bike->model}}</h4>
                        </div>
                        <div class="about d-flex">
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
            <div class="card h-70">
                <div class="card-body">
                    <ul>
                        <li><strong> Posted by:</strong> {{$bike->user->name}}</li>
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
        <div class="card">
            <div class="d-flex-column pl-2">
                <div class="about d-flex">
                    <b class="mr-2 mt-1">Average overall rating: <span id=stars></span></b>
                    <h4>{{$stars}}</h4>
                </div>
                <div class="about d-flex">
                    <b class="mr-2 mt-1">Price-performance: <span id=pp></span></b>
                    <h4>{{$pp}}</h4>
                </div>
                <div class="about d-flex">
                    <b class="mr-2 mt-1">Descend: <span id=descend></span></b>
                    <h4>{{$descend}}</h4>
                </div>
                <div class="about d-flex">
                    <b class="mr-2 mt-1">Ascend: <span id=ascend></span></b>
                    <h4>{{$ascend}}</h4>
                </div>
                <div class="about d-flex">
                    <b class="mr-2 mt-1">Agility: <span id=agility></span></b>
                    <h4>{{$agility}}</h4>
                </div>
            </div>
        </div>
        @guest
         <h4 class="pl-3">Please <a href="{{ route('login') }}">login</a> or <a href="{{ route('register') }}">register</a> to rate this bike.  </h4>
         @else
        <h2 class="mb-2">Rate this bike:</h2>
        <div class="card p-3">
            <form action="{{route('rate.bike.form', $bike->id)}}" method="post">
                @csrf
                <div class="d-flex-column">


                    <div class="form-group row">
                        <label for="brand" class="col-sm-2 col-form-label ">Overal rate</label>
                        <select class="form-select ml-4" name="overal" aria-label="Default select example" required>
                            <option selected>Open this select menu</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>

                    <div class="form-group row">
                        <label for="brand" class="col-sm-2 col-form-label ">Price/performance</label>
                        <select class="form-select ml-4" name="pp" aria-label="Default select example" required>
                            <option selected>Open this select menu</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>

                    <div class="form-group row">
                        <label for="brand" class="col-sm-2 col-form-label ">Ascend</label>
                        <select class="form-select ml-4" name="ascend" aria-label="Default select example" required>
                            <option selected>Open this select menu</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>

                    <div class="form-group row">
                        <label for="brand" class="col-sm-2 col-form-label ">Descend</label>
                        <select class="form-select ml-4" name="descend" aria-label="Default select example" required>
                            <option selected>Open this select menu</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>

                    <div class="form-group row">
                        <label for="brand" class="col-sm-2 col-form-label ">Agility</label>
                        <select class="form-select ml-4" name="agility" aria-label="Default select example" required>
                            <option selected>Open this select menu</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Users opinion</label>
                        <textarea class="form-control" id="uo" name="opinion" rows="4"></textarea>
                      </div>

                    
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary btn-dark">Add bike</button>
                        </div>
                    </div>
                </div>    
            </form>
        </div>
        @endguest
       
            @foreach ($rates as $rate)
                <div>
                    <div class="card mt-3 d-flex-column p-2">
                        <h3>Posted by: {{$rate->user->name}}</h3>
                        <ul>
                            <li>Overal rate: {{$rate->stars}}</li>
                            <li>Price-performance:  {{$rate->price_performance}}</li>
                            <li>Descending: {{$rate->descend}}</li>
                            <li>Ascending: {{$rate->ascend}}</li>
                            <li>Agility: {{$rate->agility}}</li>
                            <li>Riders opinion: {{$rate->opinion}}</li>
                        </ul>
                    </div>
                </div>
            @endforeach
        
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
