@extends('admin.layout.app')
@section('content')
<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        @if (Session::has('categorySuccess'))
        <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
            {{Session::get('categorySuccess')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>

        @endif

        <div class="row mt-4">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                    <button class="btn btn-dark btn-sm">
                        Total <span class="badge badge-light">{{$data->total()}}</span>
                    </button>
                </h3>

                <div class="card-tools">
                  <form action="{{route('admin#searchOrder')}}" method="get">
                    @csrf
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search" value="{{old('table_search')}}">

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
                      <th>Customer Name</th>
                      <th>Pizza Name</th>
                      <th>Pizza Count</th>
                      <th>Order Date</th>
                      <th></th>

                    </tr>
                  </thead>
                  <tbody>
                      @if ($emptyStatus==0)
                          <td colspan="6">
                              <small class="text-muted">There is no order</small>
                          </td>
                      @else
                      @foreach ($data as $item )
                      <tr>
                          <td>{{$item->order_id}}</td>
                          <td>{{$item->name}}</td>
                          <td>{{$item->pizza_name}}</td>
                          <td>{{$item->count}}</td>
                          <td>{{$item->order_time}}</td>

                          {{-- <td>
                              @if ($item->count==0)
                                  <a href="#" class="text-decoration-none">{{$item->count}}</a>
                              @else
                                  <a href="{{route('admin#categoryItem',$item->category_id)}}" class="text-decoration-none">{{$item->count}}</a>
                              @endif
                          </td> --}}
                          <td>
                          <a href=""><button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button></a>
                        </td>
                      </tr>
                      @endforeach

                      @endif

                  </tbody>
                </table>
                <div class="mt-3">{{$data->links()}}</div>


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
