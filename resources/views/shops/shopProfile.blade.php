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
                                    <img class="img-fluid" src="/storage/shops_profile_images/{{$shop->profile_image}}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
            <div class="card h-70">
                <div class="card-body d-flex-column">
                    <h3 class="display-4">{{$shop->name}} bike shop</h3>
                    <h4><strong>Address:</strong> {{$shop->address}}</h4>
                    <h4><strong>Post number:</strong> {{$shop->post}}</h4>
                    <ul>
                        <li><strong> Posted by:</strong> {{$shop->user->name}}</li>
                        <li><strong> Telephone number:</strong> {{$shop->tel}}</li>
                        <li><strong> Email:</strong> {{$shop->email}}</li>
                        <li><strong>  Website:  </strong>{{$shop->url}}</li>
                    </ul>
                </div>
            </div>
            </div>
            </div>
        </div>
        @guest
         <h4 class="pl-3">Please <a href="{{ route('login') }}">login</a> or <a href="{{ route('register') }}">register</a> to rate this bike.  </h4>
         @else
        <h2 class="mb-2">Rate this shop:</h2>
        <div class="card p-3 mb-3">
            <form action="{{route('rate.shop', $shop->id)}}" method="post">
                @csrf
                <div class="d-flex-column">


                    <div class="form-group row">
                        <label for="stars" class="col-sm-2 col-form-label ">Overal rate</label>
                        <select class="form-select ml-4" name="stars" aria-label="Default select example" required>
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
                            <button type="submit" class="btn btn-primary btn-dark">Post</button>
                        </div>
                    </div>
                </div>    
            </form>
        </div>

        @foreach ($rates as $rate)
        <div class="d-flex mb-4 pl-2 border border-dark rounded">
            <div class="d-flex-column">
                <div class="pt-2 pb-2">
                    <a href="{{route('profile.user', $rate->user)}}" class="font-weight-bold text-dark mb-2 mr-2">Added by: {{$rate->user->name}}</a><span class="text-secondary text-sm" style="font-size: small;"> {{$rate->created_at->diffForHumans()}}</span>
                </div>
                <div class="d-flex ">
                    <div class="p-2">
                        <p>"{{$rate->opinion}}"</p>
                    </div>
                    <div class="d-flex ml-auto p2">
                        <h2>{{$rate->stars}}</h2>
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-star mr-2 ml-1 mt-1" viewBox="0 0 16 16">
                            <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.523-3.356c.329-.314.158-.888-.283-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767l-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288l1.847-3.658 1.846 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.564.564 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
                          </svg>
                    </div>
                </div>
           </div>
        </div>
        @endforeach

        @endguest
       
          
        
</div>
@endsection
