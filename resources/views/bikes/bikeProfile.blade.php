@extends('layouts.index')

@section('content')
<div class="container d-flex-column">
        <div class="container pb-4">
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
        @guest
         <h4 class="pl-3">Please <a href="{{ route('login') }}">login</a> to rate this bike.  </h4>
         @else
        <h2 class="mb-1">Rate this bike:</h2>
        <div class="card-body">
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
    
</div>
@endsection
