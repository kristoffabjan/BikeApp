@extends('layouts.index')

@section('content')
<div class="cart-table-area section-padding-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="checkout_details_area mt-50 clearfix">

                    <div class="cart-title">
                        <h2>Add new bike shop</h2>
                    </div>

                    <form action="{{route('store.shop')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12 mb-3">
                                <input type="text" class="form-control" id="first_name" value="" name="name" placeholder="Name" required>
                            </div>
                            <div class="col-12 mb-3">
                                <input type="text" class="form-control" id="last_name" value="" name="address" placeholder="Address" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="text" class="form-control" id="post" name="post" placeholder="Post number" value="" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="text" class="form-control" id="company" placeholder="Tel. number" name="tel" value="" required>
                            </div>
                            <div class="col-12 mb-3">
                                <input type="text" name="email" class="form-control mb-3" id="email" placeholder="Email" value="" required>
                            </div>
                            <div class="col-12 mb-3">
                                <input type="url" class="form-control" name="url" id="city" placeholder="Link" value=""  required>
                            </div>
                            <div class="col-12 mb-3">
                                <input type="file" class="form-control" name="profile_image"  id="city" placeholder="Zip Code" value="" required>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn amado-btn w-100">Add Shop</button>
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
