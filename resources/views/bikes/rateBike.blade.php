@extends('layouts.index')

@section('content')
<div class="cart-table-area section-padding-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="checkout_details_area mt-20 clearfix">

                    <div class="cart-title">
                        <h2>Rate bike</h2>
                    </div>

                    <form action="{{route('rate.bike.form', $bike)}}" method="post">
                        @csrf
                        <div class="d-flex-column">


                            <div class="form-group row">
                                <label for="brand" class="col-sm-2 col-form-label ">Overallrate</label>
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
                                <textarea class="form-control" id="uo" name="opinion" rows="5"></textarea>
                                </div>

                            
                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn amado-btn mb-15">
                                        Submit rate
                                    </button>
                                </div>
                            </div>
                        </div>    
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
