@extends('admin.layout.app')
@section('content')
<div class="content-wrapper">


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row mt-4">
          <div class="col-12">
            @if (Session::has('addPizzaSuccess'))
            <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                {{Session::get('addPizzaSuccess')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif
            @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                {{Session::get('success')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif
            @if (Session::has('deleteSuccess'))
            <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                {{Session::get('deleteSuccess')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif

            <button class="btn border-none"><a href="{{route('admin#category')}}" class="text-dark"><i class="fa-solid fa-arrow-left-long me-1"></i>back</a> </button>
            <h3 class="text-center font-weight-bold">{{$data[0]->cName}}</h3>
            <div class="card">
              <div class="card-header">
                <button class="btn btn-dark btn-sm">
                    Total <span class="badge badge-light">{{$data->total()}}</span>
                </button>
                <div class="card-tools">
                <form action="{{route("admin#searchPizza")}}" method="get">
                    @csrf
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </form>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap text-center">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Pizza Name</th>
                      <th>Image</th>
                      <th>Price</th>
                      <th>Publish Status</th>
                      <th>Buy 1 Get 1 Status</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>

                      @foreach ($data as $item)
                      <tr>
                        <td>{{$item->pizza_id}}</td>
                        <td>{{$item->name}}</td>
                        <td>
                          <img src="{{asset('uploads/'.$item->image)}}" class="img-thumbnail" width="100px">
                        </td>
                        <td>{{$item->price}} kyats</td>
                        @if ($item->publish_status==0)
                        <td>NO</td>
                        @else
                        <td>Yes</td>
                        @endif

                        @if ($item->buy1_get1_status==0)
                        <td>NO</td>
                        @else
                        <td>Yes</td>
                        @endif

                        <td>
                            <a href="{{route('admin#infoPizza',$item->pizza_id)}}"><button class="btn btn-sm bg-primary text-white"><i class="fas fa-eye"></i></button></a>
                          <a href="{{route('admin#editPizza',$item->pizza_id)}}"><button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button></a>
                          <a href="{{route('admin#deletePizza',$item->pizza_id)}}"><button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button></a>
                        </td>
                      </tr>
                      @endforeach



                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection
