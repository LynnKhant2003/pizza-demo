@extends('user.layouts.style')
@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-3 col-8 offset-md-0 offset-2">
            <div class="card text-center">
                <div class="card-header bg-dark">
                    <form action="{{route('user#search')}}" method="get" class="mb-0">
                        @csrf
                        <div class="input-group mb-0">
                            <input type="text" placeholder="Enter pizza name..." class="form-control" name = "searchTable">
                            <button class="bg-dark input-group-text text-light" type = "submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </div></form>

                </div>
                <div class="card-body">
                    <a href="{{route('user#index')}}" class="text-decoration-none text-dark"><div class="border-bottom border-dark mb-3 pb-2">All</div></a>
                    @foreach ($category as $categories)
                    <a href="{{route('user#category',$categories->category_id)}}" class="text-decoration-none text-dark"><div class="border-bottom border-dark mb-3 pb-2">{{$categories->category_name}}</div></a>
                    @endforeach

                </div>

            </div>
            <form action="{{route('user#searchByPrice')}}" method="get">
                @csrf
                <div class="card text-center mt-3">
                    <div class="card-header bg-dark">
                        <h3 class="text-white">START DATE - END DATE</h3>
                    </div>
                    <div class="card-body">

                            <input type="date" name="start_date" id="" class="form-control"> -
                            <input type="date" name="end_date" id="" class="form-control">

                    </div>

                </div>
                <div class="card text-center mt-3">
                    <div class="card-header bg-dark">
                        <h3 class="text-white">Min - Max Amount</h3>
                    </div>
                    <div class="card-body">
                            <input type="number" name="min_price" id="" class="form-control" placeholder="minimum price"> -
                            <input type="number" name="max_price" id="" class="form-control" placeholder="maximun price">

                    </div>

                </div>
                <div class="text-center mt-4">
                    <button class="btn btn-dark" type = "submit">Search<i class="fa-solid fa-magnifying-glass ms-2"></i></button>
                </div>

            </form>


        </div>
        <div class="col-md-8 col-12 mt-md-0 mt-3">
            <!-- cover start -->
            <div class="carousel slide" data-bs-ride="carousel" id="slide">
                <ol class="carousel-indicators">
                    <li data-bs-target="#slide" data-bs-slide-to="0" class="active"></li>
                    <li data-bs-target="#slide" data-bs-slide-to="1"></li>
                    <li data-bs-target="#slide" data-bs-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{asset('image\how-to-keep-pizza-warm.jpg')}}" alt="pizza photo1" class="w-100" style="height: 400px;">
                    </div>
                    <div class="carousel-item">
                        <img src="{{asset('image\photo-1604382354936-07c5d9983bd3.jpg')}}" alt="pizza photo2" class="w-100" style="height: 400px;">
                    </div>
                    <div class="carousel-item">
                        <img class="w-100" src="{{asset('image\pizza-margarita-fast-food-pizza-with-vegetables-pizza-without-meat.jpg')}}" alt="pizza photo3" style="height: 400px;">
                    </div>
                </div>
                <a href="#slide" class="carousel-control-prev" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </a>
                <a href="#slide" class="carousel-control-next" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </a>
            </div>
            <!-- cover end -->

            <div class="shadow p-2 my-2" id="pizza">
                <div class="container-fluid my-3 ">
                    <div class="row">
                        @if ($status == 0)
                        <div class="col-6 offset-3 text-center">
                            <h3 class="text-warning">There is no Pizza</h3>
                        </div>

                        @else
                        @foreach($data as $item)
                        <div class="col-md-4 col-8 offset-md-0 offset-2 mt-3">
                            <div class="card text-center shadow" >
                                @if ($item->buy1_get1_status==1)
                                <div class="badge bg-danger text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Buy one get one</div>
                                @else
                                <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                                @endif

                                <img src="{{asset('uploads/'.$item->image)}}" class="card-img-top pizza-image" alt="Sunset Over the Sea" style="height: 140px;" />
                                <div class="card-body bg-dark">
                                    <p class="card-text text-light font-weight-bold">{{$item->name}}</p>
                                    <small class="card-text text-light d-block mb-3">{{$item->price}} Kyats</small>
                                    <a href="{{route('contact#details',$item->pizza_id)}}"><button class="btn btn-outline-white text-white">More Details</button></a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <div class="mt-3">{{$data->links()}}</div>


        </div>
    </div>
</div>
<div class="container-fluid bg-dark py-2 mt-3" id="contact">
    <div class="mb-3">
        <div class="text-center h2 text-light">Contact Us</div>
        <div>
            <form action="{{route('contact#index')}}" method='post'>
                @csrf
                <div class="row">
                    <div class="offset-4 col-4">

                        <input type="text" class="form-control my-2 bg-light" placeholder="Name.." name = 'name' value="{{old('name')}}">
                        @if($errors->has('name'))
                            <p class="text-danger">{{$errors->first('name')}}</p>
                            @endif
                        <input type="email" class="form-control my-2 bg-light" placeholder="Email.." name= 'email' value='{{old('email')}}'>
                        @if($errors->has('email'))
                        <p class="text-danger">{{$errors->first('name')}}</p>
                        @endif
                        <textarea  id="" cols="30" rows="10" class="my-2 form-control bg-light mt-2 " placeholder="Enter Message" name='message'>{{old('message')}}</textarea>
                        @if($errors->has('message'))
                        <p class="text-danger">{{$errors->first('message')}}</p>
                        @endif
                        <button type="submit" class="btn btn-white float-end" >Send</button>
                    </div>

                </div>
            </form>

        </div>

    </div>
</div>
@endsection
