@extends('admin.layout.app')
@section('content')
<div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="row mt-4">
          <div class="col-8 offset-3 mt-5">
            <div class="col-md-9">
                <a href="{{route('admin#pizza')}}">
                    <div class="mb-3 text-dark btn btn-white">
                    <i class="fa-solid fa-left-long"></i>Back
                </div>
            </a>

              <div class="card">
                <div class="card-header p-2">
                  <legend class="text-center">Add Pizza</legend>
                </div>
                <div class="card-body">
                  <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                      <form class="form-horizontal" action="{{route('admin#insertPizza')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                          <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputName" placeholder="Name" value="{{old('name')}}" name="name">
                            @if($errors->has('name'))
                            <p class="text-danger">{{$errors->first('name')}}</p>
                            @endif
                          </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Image</label>
                            <div class="col-sm-10">
                              <input type="file" class="form-control" id="inputName" placeholder="" value="{{old('image')}}" name="image">
                              @if($errors->has('image'))
                              <p class="text-danger">{{$errors->first('image')}}</p>
                              @endif
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Price</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="inputName" placeholder="Price" value="{{old('price')}}" name="price">
                              @if($errors->has('price'))
                              <p class="text-danger">{{$errors->first('price')}}</p>
                              @endif
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Publish Status</label>
                            <div class="col-sm-10">
                              <select name="PublishStatus" id="" class="form-select">
                                  <option value="1">Publish</option>
                                  <option value="0">Unpublish</option>

                              </select>
                              {{-- @if($errors->has('name'))
                              <p class="text-danger">{{$errors->first('name')}}</p>
                              @endif --}}
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Category</label>
                            <div class="col-sm-10">

                                <select name="Category" id="" class="form-select">
                                    <option value="null">Choose Category</option>
                                    @foreach ($category as $item )
                                    <option value="{{$item->category_id}}">{{$item->category_name}}</option>
                                    @endforeach
                                </select>


                              @if($errors->has('Category'))
                              <p class="text-danger">{{$errors->first('Category')}}</p>
                              @endif
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Discount</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="inputName" placeholder="Name" value="{{old('discount')}}" name="discount">
                              @if($errors->has('name'))
                              <p class="text-danger">{{$errors->first('discount')}}</p>
                              @endif
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Buy 1 Get 1</label>
                            <div class="col-sm-10 mt-2">

                                  <input type="radio" name="b1g1" id="" value="1">Yes
                                  <input type="radio" name="b1g1" id="" value="0">No
                              </select>
                              {{-- @if($errors->has('name'))
                              <p class="text-danger">{{$errors->first('name')}}</p>
                              @endif --}}
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Waiting Time</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" id="inputName" placeholder="Name" value="{{old('wait')}}" name="wait">
                              @if($errors->has('wait'))
                              <p class="text-danger">{{$errors->first('wait')}}</p>
                              @endif
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                                <textarea name="description" id="" cols="30" rows="10" class="form-control" value="{{old('description')}}"></textarea>
                                @if($errors->has('description'))
                              <p class="text-danger">{{$errors->first('description')}}</p>
                              @endif
                            </div>
                          </div>
                        <div class="form-group row">
                          <div class="offset-sm-2 col-sm-10">
                            <button type="submit" class="btn bg-dark text-white float-right">Add</button>
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

