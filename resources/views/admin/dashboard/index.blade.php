@extends('admin.layouts.app')

@section('title', __('Dashboard'))

@section('content')
<div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Welcome to admin page</h5>

          <p class="card-text">
            
          </p>

          <a href="{{ route('admin.product.create') }}" class="card-link">Add new Product</a>
          <a href="{{ route('admin.users.create') }}" class="card-link">Add new user</a>
        </div>
      </div>
    </div>
    <!-- /.col-md-6 -->
    
  </div>
  <!-- /.row -->
@endsection
