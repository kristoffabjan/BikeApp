@extends('layouts.index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 d-flex-col">
            <h2>Add bikes that are currently available in your shop:</h2>

            @foreach ($bikes as $bike)
                <div class="d-flex mb-4 pl-2 border border-dark rounded" >
                    <div class="mr-3">
                        <div class="user-avatar">
                            <img class="img-thumbnail" style="max-width: 250px" src="/storage/bikes_profile_images/{{$bike->profile_image}}" alt="">
                        </div>
                    </div>
                    <div class="d-flex-column">
                        <div class="pt-2 pb-2">
                            <a href="{{route('profile.user', $bike->user)}}" class="font-weight-bold text-dark mb-2 mr-2">Added by: {{$bike->user->name}}</a><span class="text-secondary text-sm" style="font-size: small;"> {{$bike->created_at->diffForHumans()}}</span>
                        </div>
                        <div class="pb-2">
                            <h2>{{$bike->brand}}</h2>
                        </div>
                        <div>
                            <a href="{{route('rate.bike', $bike->id)}}">
                                <h3>{{$bike->model}}</h3>
                            </a>
                        </div>
                    </div>
                    <div class="ml-auto d-flex justify-content-center align-items-center pr-4" >
                        <a class="btn btn-dark btn-lg " href="{{route('bikeToShop.add', [$shop, $bike])}}" onclick="hideBike()" role="button"
                        id="addButton">Add</a>
                    </div>
                </div>
            @endforeach
    </div>
</div>
<script>
    function hideBike() {
        var list = document.getElementById("addButton");
        var flag = 0;
    
        if (list.style.display === "block" && (flag===0)){
            list.style.visibility = "none";
            flag = 1;
        }else{
            list.style.visibility = "none";
        }
    }
</script>
@endsection

