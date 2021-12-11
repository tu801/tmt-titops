@extends('layouts.app')

@section('content')
<div class="container py-1">
    <div class="row text-center mb-2">
        <div class="col-lg-7 mx-auto">
            <h1 class="display-4">{{ __('Product List') }}</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <!-- List group-->
            <ul class="list-group shadow">
                @foreach ($products as $item) 
                    <!-- list group item--> 
                <li class="list-group-item">
                    <!-- Custom content-->
                    <div class="media align-items-lg-center flex-column flex-lg-row p-3">
                        <div class="media-body order-2 order-lg-1">
                            <h5 class="mt-0 font-weight-bold mb-2">{{ $item->name }}</h5>
                            <p class="font-italic text-muted mb-0 small">{{ $item->description }}</p>
                            <div class="d-flex align-items-center justify-content-between mt-1">
                                <h6 class="font-weight-bold my-2">{{ $item->price }}</h6>
                                <h6 class="font-weight-bold my-2">{{ $item->BrandInfo->name }}</h6>
                                
                            </div>
                        </div>
                        <img src="{{ asset('storage/uploads/products/'.$item->slide[0]->name) }}" alt="{{ $item->name }}" width="200" class="ml-lg-5 order-1 order-lg-2">
                    </div> <!-- End -->
                    <a href="{{ route('productDetail', $item->id) }}" class="btn btn-success">{{ __('Detail')}}</a>
                </li> <!-- End -->
                @endforeach
                
            </ul> <!-- End -->
        </div>
    </div>
</div>

@endsection
