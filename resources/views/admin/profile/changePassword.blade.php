@extends('admin.layout.app')
@section('content')
<div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="row mt-4">
          <div class="col-8 offset-3 mt-5">
            <div class="col-md-9">
                {{-- @if (Session::has('updateSuccess'))
            <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                {{Session::get('updateSuccess')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div> --}}
              @if (Session::has('passwordError'))
              <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                  {{Session::get('passwordError')}}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              @endif
              @if (Session::has('notSameError'))
              <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                  {{Session::get('notSameError')}}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              @endif
              @if (Session::has('lengthError'))
              <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                  {{Session::get('lengthError')}}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              @endif
              @if (Session::has('success'))
              <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                  {{Session::get('success')}}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              @endif
              <div class="card">
                <div class="card-header p-2">
                  <legend class="text-center">Change Password</legend>
                </div>
                <div class="card-body">
                  <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                      <form class="form-horizontal" action="{{route('admin#confirmPassword',auth()->user()->id)}}" method="POST">
                        @csrf

                          <label for="inputName" class="form-label mt-3">Old Password</label>

                            <input type="password" class="form-control " id="inputName" placeholder="..." value="{{old('oldPassword')}}" name='oldPassword'>
                            @if ($errors->has('oldPassword'))
                            <p class="text-danger">{{$errors->first('oldPassword')}}</p>
                            @endif




                          <label for="inputEmail" class="form-label mt-3">New Password</label>

                            <input type="password" class="form-control" id="inputEmail" placeholder="..." value="{{old('newPassword')}}" name='newPassword'>
                            @if ($errors->has('newPassword'))
                            <p class="text-danger">{{$errors->first('newPassword')}}</p>
                            @endif


                            <label for="inputPhone" class="form-label mt-3">Confirm Password</label>

                              <input type="password" class="form-control " id="inputPhone" placeholder="..." value="{{old('confirmPassword')}}" name='confirmPassword'>
                              @if ($errors->has('confirmPassword'))
                              <p class="text-danger">{{$errors->first('confirmPassword')}}</p>
                              @endif
                            <button type="submit" class="btn bg-dark text-white float-right mt-3" >Confirm</button>

                      </form>


                    <!-- Modal -->

                    </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
