@extends('layouts.index')

@section('content')


<div class="cart-table-area section-padding-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="checkout_details_area mt-50 clearfix">

                    <div class="cart-title">
                        <h2>Register</h2>
                    </div>
                        

                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="row">

                            <div class="col-12 mb-3">
                                <input type="text"  class="form-control @error('name') is-invalid @enderror" id="first_name" name="name"  value="{{ old('name') }}" placeholder="Name" 
                                autocomplete="name" required autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-12 mb-3">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"  value="{{ old('email') }}" placeholder="Email" 
                                autocomplete="email" required >
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 mb-3">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password" value="" name="password" required autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-12 mb-3">
                                <input type="password" class="form-control" id="password" placeholder="Confirm password" value="" name="password_confirmation" required autocomplete="new-password">
                                
                            </div>
    
                            <div class="col-12 form-group row mb-0">
                                <div class="col-md-8 ">
                                    <button type="submit" class="btn amado-btn mb-15">
                                        {{ __('Register') }}
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
