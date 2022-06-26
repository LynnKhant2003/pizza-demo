@extends('user.layouts.style')
@section('content')
<div class="row mt-5 d-flex justify-content-center">

    <div class="col-4 ">
        <img src="{{asset('uploads/'.$data['image'])}}" class="img-thumbnail" width="100%">            <br>
        <a href="{{route('contact#details',$data['pizza_id'])}}">
            <button class="btn bg-dark text-white" style="margin-top: 20px;" type="submit">
                <i class="fa-solid fa-arrow-left"></i> Back
            </button>
        </a>
    </div>
    <div class="col-6">
        @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
            {{Session::get('success')}} minutes
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>

        @endif
        <h5>Name</h5>
        <small class="text-muted">{{$data['name']}}</small>
        <hr>
        <h5>Price</h5>
        <small class="text-muted">{{$data['price'] - $data['discount_price']}} Kyats</small>
        <hr>

        <h5>Waiting Time</h5>
        <small class="text-muted">{{$data['waiting_time']}} Minutes</small>
        <hr>
        <form action="{{route('user#placeOrder')}}" method="POST">
            @csrf
            <h5>Pizza Count</h5>
            <input type="number" name="pizza_count" id="" class="form-control" placeholder="Number of pizza you want">
            @if ($errors->has('pizza_count'))
              <p class="text-danger">{{$errors->first('pizza_count')}}</p>
            @endif
            <hr>
            <h5>Payment Type</h5>
            <div class="form-check form-check-inline">
                <input type="radio" class="form-check-input" id='radio1' name='paymentType' value="1">
                <label for="radio1" class="form-check-label">Cash</label>
            </div>
            <div class="form-check form-check-inline">
                <input type="radio" class="form-check-input" id='radio2' name='paymentType' value="2">
                <label for="radio2" class="form-check-label">Credit Card</label>
            </div>
            @if ($errors->has('pizza_count'))
            <p class="text-danger">{{$errors->first('pizza_count')}}</p>
          @endif
            <button class="btn btn-primary float-end mt-2 col-12" type="submit"><i class="fas fa-shopping-cart"></i>Order</button>

        </form>
    </div>


</div>

@endsection
