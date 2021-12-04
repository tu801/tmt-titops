@extends('admin.layouts.app')


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Create New Product</h3>
                    <div class="card-tools">
                        <ul class="nav nav-pills ml-auto">
                            <li class="nav-item">
                                <a class="nav-link active" href="{{ route('admin.product.list') }}" >Back</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="card-body">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.product.create') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" >Name:</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" class="form-control" placeholder="Name">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" >Price:</label>
                            <div class="col-sm-10">
                                <input type="text" name="price" class="form-control" placeholder="Price">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" >Brand:</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="brand_id">
                                    @foreach($brands as $item)
                                    <option value="{{$item->id}}" >{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" >Image:</label>
                            <div class="col-sm-10">
                                <div class="custom-file">
                                    <input type="file" name="images" class="custom-file-input" id="customFile">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Detail:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" style="height:150px" name="description" placeholder="Detail"></textarea>
                            </div>
                        </div>

                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection
