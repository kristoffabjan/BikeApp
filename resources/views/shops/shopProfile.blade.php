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
        <div class="card p-3">
            <form action="" method="post">
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
       
          
        
</div>
@endsection
