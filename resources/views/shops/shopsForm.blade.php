@extends('layouts.index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 d-flex-col">
            <div>
                <form action="{{route('store.shop')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="brand" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" id="name" placeholder="name" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bikeModel" class="col-sm-2 col-form-label">Address</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" name="address"  id="address" placeholder="Address" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="date" class="col-sm-2 col-form-label">Post number</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" name="post" id="post" placeholder="Post number" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="price" class="col-sm-2 col-form-label">Telephone number</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" name="tel"  id="tel" placeholder="Phone" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="suspension" class="col-sm-2 col-form-label">Email address</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" name="email" id="email" placeholder="email" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bikeLink" class="col-sm-2 col-form-label">Link to webpage</label>
                        <div class="col-sm-10">
                        <input type="url" class="form-control" id="url" name="url"  placeholder="Url" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="profile_image" class="col-sm-2 col-form-label">Shops profile pic</label>
                        <div class="col-sm-10">
                        <input type="file" class="form" id="profile_image" name="profile_image"  placeholder="Image" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary btn-dark">Add shop</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
