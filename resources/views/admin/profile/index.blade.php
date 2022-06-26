@extends('admin.layout.app')
@section('content')
<div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="row mt-4">
          <div class="col-8 offset-3 mt-5">
            <div class="col-md-9">
                @if (Session::has('updateSuccess'))
            <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                {{Session::get('updateSuccess')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif
              <div class="card">
                <div class="card-header p-2">
                  <legend class="text-center">User Profile</legend>
                </div>
                <div class="card-body">
                  <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                      <form class="form-horizontal" action="{{route('admin#update',$data['id'])}}" method="POST">
                        @csrf
                        <div class="form-group row">
                          <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputName" placeholder="Name" value="{{$data['name']}}" name='Name'>
                            @if ($errors->has('Name'))
                            <p class="text-danger">{{$errors->first('Name')}}</p>
                            @endif
                        </div>

                        </div>
                        <div class="form-group row">
                          <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                          <div class="col-sm-10">
                            <input type="email" class="form-control" id="inputEmail" placeholder="Email" value="{{$data['email']}}" name='Email'>
                            @if ($errors->has('Email'))
                            <p class="text-danger">{{$errors->first('Email')}}</p>
                            @endif
                        </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPhone" class="col-sm-2 col-form-label">Phone</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="inputPhone" placeholder="Phone Number" value="{{$data['phone']}}" name='Phone'>
                              @if ($errors->has('Phone'))
                              <p class="text-danger">{{$errors->first('Phone')}}</p>
                              @endif
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputAdress" class="col-sm-2 col-form-label">Address</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="inputAdress" placeholder="Address" value="{{$data['address']}}" name='Address'>
                              @if ($errors->has('Address'))
                              <p class="text-danger">{{$errors->first('Address')}}</p>
                              @endif
                            </div>
                          </div>

                        <div class="form-group row">
                          <div class="offset-sm-2 col-sm-10">
                           <!-- Button trigger modal -->
                                <div type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop" class="text-primary">
                                    <a href="{{route('admin#changePassword')}}"> Change Password</a>
                                </div>
                                <!-- Modal -->
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="offset-sm-2 col-sm-10">
                            <button type="submit" class="btn bg-dark text-white float-right" >Update</button>
                          </div>
                        </div>
                      </form>

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
