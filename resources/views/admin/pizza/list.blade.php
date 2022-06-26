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
            <div class="card">
              <div class="card-header">
                <a href="{{route('admin#addPizza')}}"><button class=" btn bg-dark text-white btn-sm"><i class="fa-solid fa-plus"></i></button></a>
                <button class="btn btn-dark btn-sm">
                    Total <span class="badge badge-light">{{$data->total()}}</span>
                </button>
                <a href="{{route('admin#downloadPizza')}}"><button class="btn btn-success btn-sm ms-1"><i class="fa-solid fa-file-arrow-down me-1"></i>Download CSV</button></a>

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
                      @if($status==0)
                        <tr>
                            <td colspan=7 class="text-muted">
                                <small class="text-muted"> There is no data</small>
                            </td>
                        </tr>
                      @else
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
                      @endif


                    {{-- <tr>
                      <td>2</td>
                      <td>Vegatable</td>
                      <td>
                         <img src="http://simply-delicious-food.com/wp-content/uploads/2020/06/Grilled-Pizza-Margherita-3.jpg" class="img-thumbnail" width="100px">
                      </td>
                      <td>20000 kyats</td>
                      <td>Yes</td>
                      <td>Yes</td>
                      <td>
                        <button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button>
                        <button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button>
                      </td>
                    </tr>
                    <tr>
                      <td>3</td>
                      <td>Vegatable</td>
                      <td>
                         <img src="https://www.biggerbolderbaking.com/wp-content/uploads/2019/07/15-Minute-Pizza-WS-Thumbnail.png" class="img-thumbnail" width="100px">
                      </td>
                      <td>20000 kyats</td>
                      <td>Yes</td>
                      <td>Yes</td>
                      <td>
                        <button class="btn btn-sm bg-dark text-white" ><i class="fas fa-edit"></i></button>
                        <button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button>
                      </td>
                    </tr> --}}
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
