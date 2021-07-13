@extends('layouts.index')

@section('content')
<div class="cart-table-area section-padding-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="checkout_details_area mt-20 clearfix">

                    

                    <h2 class="mb-2">Rate shop:</h2>
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
