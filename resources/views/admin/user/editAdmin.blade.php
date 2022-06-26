
@extends('admin.layout.app')
@section('content')
<div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="row mt-4">
          <div class="col-8 offset-3 mt-5">
            <div class="col-md-9">
              <div class="card">
                <div class="card-header">
                    <legend class="text-center">Edit Admin</legend>
                </div>
                <div class="card-body">
                    <form action="">
                        <label for="" class="form-label">Name</label>
                        <input type="text" class="form-control">
                        <label for="" class="form-label">Email</label>
                        <input type="email" class="form-control">
                        <label for="" class="form-label">Phone</label>
                        <input type="tel" class="form-control">
                        <label for="" class="form-label">Role</label>
                        <select name="" id="" class="form-select">
                            <option value="1">Admin</option>
                            <option value="0">User</option>

                        </select>
                        <label for="" class="form-label">Address</label>
                        <textarea name="" id="" cols="30" rows="10" class="form-control"></textarea>
                    </form>
                </div>
            </div>
            </div>
            </div>
        </div>
        </div>
    </section>
  </div>
@endsection



