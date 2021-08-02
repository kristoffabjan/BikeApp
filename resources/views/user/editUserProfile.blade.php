@extends('layouts.index')

@section('content')
<div class="container">
    <div class="row py-5 px-4">
        <div class="col-md-12 mx-auto">
            <!-- Profile widget -->
            <div class="bg-white shadow rounded overflow-hidden">
                <div class="px-4 pt-0 pb-4 cover">
                    <div class="media align-items-end profile-head">
                        <div class="profile mr-3">
                            <img src="https://pointchurch.com/wp-content/uploads/2019/02/Blank-Person-Image.png" alt="..." width="130" class="rounded mb-2 img-thumbnail">
                            
                        </div>
                        <div class="media-body mb-5 text-white">
                            <h4 class="mt-0 mb-10" style="color: white">{{$user->name}}</h4>
                            <!-- <p class="small mb-4"> <i class="fas fa-map-marker-alt mr-2"></i>New York</p> -->
                        </div>
                    </div>
                </div>
                <div class="bg-light p-4 d-flex justify-content-end text-center">
                    
                </div>
                <div class="px-4 py-3">
                    <h5 class="mb-3">Edit</h5>
                    <form action="{{ route('edit.user.profile.data', $user)}}" method="POST">
                        @csrf
                        <div class="row">

                            <div class="col-12 mb-3">
                                <input type="text"  class="form-control @error('name') is-invalid @enderror" id="first_name" name="name"  value="{{ old('name') }}" placeholder="Name" 
                                autocomplete="name"  autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-12 mb-3">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"  value="{{ old('email') }}" placeholder="Email" 
                                autocomplete="email"  >
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12 mb-3">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password" value="" name="password"  autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-12 mb-3">
                                <input type="password" class="form-control" id="password" placeholder="Confirm password" value="" name="password_confirmation"  autocomplete="new-password">
                                
                            </div>
    
                            <div class="col-12 form-group row mb-0">
                                <div class="col-md-8 ">
                                    <button type="submit" class="btn amado-btn mb-15">
                                        Change
                                    </button>
    
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="px-4 py-3">
                    
                    <form action="{{ route('delete.user' , $user) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <input class="btn btn-danger btn-block" type="submit" value="Delete">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
