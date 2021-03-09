@extends('layouts.index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 d-flex-col">
            <h1 class="mb-2">Submit magazine test for this bike</h1>
            <div class="mt-2">
                <form action="{{route('new.test', $bikeId)}}" method="post" >
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Article name:</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Name"  required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="magazine" class="col-sm-2 col-form-label">Magazine: </label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" name="magazine"  id="magazine" placeholder="Magazine" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="url" class="col-sm-2 col-form-label">Link: </label>
                        <div class="col-sm-10">
                        <input type="url" class="form-control" name="url"  id="url" placeholder="Link" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary btn-dark">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
