@extends('user.layouts.style')
@section('content')
<div class="row mt-5 d-flex justify-content-center">

    <div class="col-4 ">
        <img src="{{asset('uploads/'.$data->image)}}" class="img-thumbnail" width="100%">            <br>
        <a href="{{route('user#order')}}"><button class="btn btn-primary float-end mt-2 col-12"><i class="fas fa-shopping-cart"></i>Order</button></a>
        <a href="{{route('user#index')}}">
            <button class="btn bg-dark text-white" style="margin-top: 20px;">
                <i class="fa-solid fa-arrow-left"></i> Back
            </button>
        </a>
    </div>
    <div class="col-6">
        <h5>Name</h5>
        <small class="text-muted">{{$data->name}}</small>
        <hr>
        <h5>Price</h5>
        <small class="text-muted">{{$data->price}} Kyats</small>
        <hr>
        <h5>Discount Price</h5>
        <small class="text-muted">{{$data->discount_price}} Kyats</small>
        <hr>
        <h5>Buy One Get One</h5>
        @if($data->buy1_get1_status==1)
        <small class="text-muted">Have</small>
        <hr>
        @else
        <small class="text-muted">Not Have</small>
        <hr>
        @endif
        <h5>Waiting Time</h5>
        <small class="text-muted">{{$data->waiting_time}} Minutes</small>
        <hr>
        <h5>Description</h5>
        <small class="text-muted">{{$data->description}}</small>
        <hr>
        <h3 class="text-success">Total price</h3>
        <small class="text-muted mb-5">{{$data->price - $data->discount_price}} Kyats</small>
        <hr>

    </div>
</div>

@endsection
