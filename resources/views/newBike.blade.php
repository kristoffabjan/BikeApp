@extends('layouts.index')

@section('content')
<div class="cart-table-area section-padding-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="checkout_details_area mt-50 clearfix">

                    <div class="cart-title">
                        <h2>Add new bike</h2>
                    </div>

                    <form action="{{route('addNewBike')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <input type="text" class="form-control" id="first_name" value="" name="brand" placeholder="Brand" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="text" class="form-control" id="last_name" value="" name="model" placeholder="Model" required>
                            </div>
                            <div class="col-12 mb-3">
                                <input type="date" class="form-control" id="company" name="release_date" placeholder="Release date" value="" required>
                            </div>
                            <div class="col-12 mb-3">
                                <input type="number" class="form-control" id="company" placeholder="Price(€)" name="price" value="" required>
                            </div>
                            <div class="col-12 mb-3">
                                <input type="number" name="suspension_range" class="form-control mb-3" id="street_address" placeholder="Suspension(mm)" value="" required>
                            </div>
                            <div class="col-12 mb-3">
                                <input type="url" class="form-control" name="url" id="city" placeholder="Link to manufacturer" value="" required>
                            </div>
                            <div class="col-12 mb-3">
                                <input type="file" class="form-control" name="profile_image"  id="city" placeholder="Zip Code" value="" required>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn amado-btn w-100">Add bike</button>
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
