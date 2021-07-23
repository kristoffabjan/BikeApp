@extends('layouts.index')

@section('content')
<div class="cart-table-area section-padding-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="checkout_details_area mt-20 clearfix">

                    <div class="cart-title">
                        <h2>Edit official magazine test:</h2>
                    </div>

                    <form action="{{route('edit.test', [$test, $bike])}}" method="post" >
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
                                <button type="submit" class="btn amado-btn mb-15">
                                    Edit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
