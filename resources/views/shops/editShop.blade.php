@extends('layouts.index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 d-flex-col">
            <h2 class="mb-20 mt-30">Edit shop data:</h2>
            <div>
                <form action="{{route('edit.shop.data', $shop)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="brand" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" id="name" placeholder="name" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bikeModel" class="col-sm-2 col-form-label">Address</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" name="address"  id="address" placeholder="Address" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="date" class="col-sm-2 col-form-label">Post number</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" name="post" id="post" placeholder="Post number" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="price" class="col-sm-2 col-form-label">Telephone number</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" name="tel"  id="tel" placeholder="Phone" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="suspension" class="col-sm-2 col-form-label">Email address</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" name="email" id="email" placeholder="email" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bikeLink" class="col-sm-2 col-form-label">Link to webpage</label>
                        <div class="col-sm-10">
                        <input type="url" class="form-control" id="url" name="url"  placeholder="Url" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary btn-dark">Confirm changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
