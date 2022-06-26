@extends('admin.layout.app')
@section('content')
<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-8 offset-2">

                    <a href="{{route('admin#pizza')}}">
                        <div class="mb-2 text-dark btn btn-white mt-2">
                        <i class="fa-solid fa-left-long"></i>Back
                    </div>
                    </a>
                <div class="card">
                    <div class="card-header text-center h2 bg-dark text-light">Pizza info</div>
                    <div class="card-body ">
                        <div class="text-center">
                            <img src="{{asset('uploads/'.$data->image)}}" alt=""
                        style="width: 35%; height: 35%;"
                        class="border border-dark rounded-circle">
                        </div>

                        <div class="container mt-3">
                            <div class="row">
                                <div class=" offset-4">
                                    <div>
                                        <span for="" class='fw-bold'>Name- </span><span for="" >{{$data->name}}</span>
                                    </div>
                                    <div>
                                        <span for=""class='fw-bold'>Price- </span><span for="" >{{$data->price}} kyats</span>
                                    </div>
                                    <div>
                                        <span for=""class='fw-bold'>Publish-status- </span>
                                        @if ($data->publish_status==0)
                                        <span for="" >No</span>
                                        @else
                                        <span for="" >Yes</span>
                                        @endif

                                    </div>
                                    <div>
                                        <span for=""class='fw-bold'>Buy one get one- </span>
                                        @if ($data->buy1_get1_status==0)
                                        <span for="" >No</span>
                                        @else
                                        <span for="" >Yes</span>
                                        @endif

                                    </div>
                                    <div>
                                        <span for=""class='fw-bold'>Category- </span><span for="" >{{$data->category_id}}</span>
                                    </div>
                                    <div>
                                        <span for=""class='fw-bold'>Discount- </span><span for="" >{{$data->discount_price}} kyats</span>
                                    </div>
                                    <div>
                                        <span for=""class='fw-bold'>Waiting time- </span><span for="" >{{$data->waiting_time}} minutes</span>
                                    </div>
                                    <div>
                                        <span for=""class='fw-bold'>Description- </span><span for="" >{{$data->description}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection
