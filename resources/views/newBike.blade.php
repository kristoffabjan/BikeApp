@extends('layouts.index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 d-flex-col">
            <div>
                <form action="{{route('addNewBike')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="brand" class="col-sm-2 col-form-label">Brand</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" name="brand" id="brand" placeholder="Brand" value="{{old('brandBike')}}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bikeModel" class="col-sm-2 col-form-label">Model</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" name="model"  id="bikeModel" placeholder="Model" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="date" class="col-sm-2 col-form-label">Released to public</label>
                        <div class="col-sm-10">
                        <input type="date" class="form-control" name="release_date" id="releaseDate" placeholder="Release date" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="price" class="col-sm-2 col-form-label">Price(€)</label>
                        <div class="col-sm-10">
                        <input type="number" class="form-control" name="price"  id="price" placeholder="Price" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="suspension" class="col-sm-2 col-form-label">Suspension(mm)</label>
                        <div class="col-sm-10">
                        <input type="number" class="form-control" name="suspension_range" id="suspension" placeholder="Suspension(mm)" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bikeLink" class="col-sm-2 col-form-label">Link to manufacturer</label>
                        <div class="col-sm-10">
                        <input type="url" class="form-control" id="bikeLink" name="url"  placeholder="Url" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="profile_image" class="col-sm-2 col-form-label">Bikes profile pic</label>
                        <div class="col-sm-10">
                        <input type="file" class="form" id="profile_image" name="profile_image"  placeholder="Image" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary btn-dark">Add bike</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
