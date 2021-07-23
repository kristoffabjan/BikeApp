@extends('layouts.index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 d-flex-col mt-10">
            <h2 class="mb-20 mt-30">Edit shop rate:</h2>
            <div class="card p-3 mb-3">
                <form action="{{route('edit.shop.rate.data', [$rate, $shop])}}" method="post">
                    @csrf
                    <div class="d-flex-column">


                        <div class="form-group row">
                            <label for="stars" class="col-sm-2 col-form-label ">Overall rate</label>
                            <select class="form-select ml-4" name="stars" aria-label="Default select example" >
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
                                <button type="submit" class="btn btn-primary btn-dark">Confirm changes</button>
                            </div>
                        </div>
                    </div>    
                </form>
            </div>
        </div>
    </div>
</div>

@endsection