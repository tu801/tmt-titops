@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Product Detail</h3>
                <div class="card-tools">
                    <ul class="nav nav-pills ml-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('admin.product.list') }}" >Back</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="card-body">
                <div class="form-group row">
                    <label class="col-3">Name:</label>
                    <div class="col-9">
                        {{ $product->name }}
                    </div>
                </div>
                
                <div class="form-group row">
                    <label class="col-3">Price:</label>
                    <div class="col-9">
                        {{ $product->price }}
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-3">Brand:</label>
                    <div class="col-9">
                        {{ $product->BrandInfo->name }}
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-3">Images:</label>
                    <div class="col-9">
                        <div class="row">
                            @if (isset($product->slide) && count($product->slide) > 0 )
                                @foreach( $product->slide as $img )
                                    <img src="{{ asset('storage/uploads/products/'.$img->name) }}" class="col-3 img-thumb mb-2"  />
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-3">Details:</label>
                    <div class="col-9">
                        {{ $product->description }}
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


@endsection