@extends('admin.layouts.app')


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"> Products</h3>
                    <div class="card-tools">
                        <ul class="nav nav-pills ml-auto">
                            <li class="nav-item">
                                <a class="btn btn-success" href="{{ route('admin.product.create') }}"> Create New Product</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="card-body">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <table class="table table-bordered">
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Price</th>
                            <th width="280px">Action</th>
                        </tr>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->image }}
                                    <img src="{{ asset('storage/uploads/products/'.$product->images) }}" class="img-thumbnail img-lg">
                                </td>
                                <td>{{ $product->price }}</td>
                                <td>
                                    <form action="{{ route('admin.product.delete',$product->id) }}" method="POST">
                                        <a class="btn btn-info" href="{{ route('admin.product.detail',$product->id) }}">Show</a>
                                        @can('product-edit')
                                            <a class="btn btn-primary" href="{{ route('admin.product.edit',$product->id) }}">Edit</a>
                                        @endcan


                                        @csrf
                                        @method('DELETE')
                                        @can('product-delete')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        @endcan
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>

                </div>
            </div>
        </div>
    </div>

@endsection
