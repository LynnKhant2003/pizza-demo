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
        @if (Session::has('deleteSuccess'))
        <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
            {{Session::get('deleteSuccess')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>

        @endif
        @if (Session::has('editSuccess'))
        <div class="alert alert-warning alert-dismissible fade show mt-2" role="alert">
            {{Session::get('editSuccess')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>

        @endif
        <div class="row mt-4">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <a href="{{route('admin#addCategory')}}"><button class="btn btn-sm btn-dark"><i class="fa-solid fa-plus"></i></button></a>
                <button class="btn btn-dark btn-sm">
                    Total <span class="badge badge-light">{{$data->total()}}</span>
                </button>
                </h3>
                <a href="{{route('admin#downloadList')}}"><button class="btn btn-success btn-sm ms-1"><i class="fa-solid fa-file-arrow-down me-1"></i>Download CSV</button></a>

                <div class="card-tools mb-0">
                  <form action="{{route('admin#searchCategory')}}" method="get">
                    @csrf
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search" value="{{old('table_search')}}">

                        <div class="input-group-append">
                          <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                          </button>
                        </div>
                      </div></form>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap text-center">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Category Name</th>
                      <th>Product Count</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($data as $item )
                    <tr>
                        <td>{{$item->category_id}}</td>
                        <td>{{$item->category_name}}</td>
                        <td>
                            @if ($item->count==0)
                                <a href="#" class="text-decoration-none">{{$item->count}}</a>
                            @else
                                <a href="{{route('admin#categoryItem',$item->category_id)}}" class="text-decoration-none">{{$item->count}}</a>
                            @endif
                        </td>
                        <td>
                        <a href="{{route('admin#editCategory',$item->category_id)}}"><button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button></a>
                        <a href="{{route('admin#deleteCategory',$item->category_id)}}"><button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button></a>
                      </td>
                    </tr>
                    @endforeach

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
