@extends('layouts.app')

@section('content')
    <div class="container">
        <!--Section: Block Content-->
        <section class="mb-5">

            <div class="row">
                <div class="col-md-6 mb-4 mb-md-0">
                    <div class="row product-gallery mx-1">

                        <div class="col-12 mb-0">
                            <figure class="view overlay rounded z-depth-1 main-img" id="mainImg">
                                <img src="{{ asset('storage/uploads/products/'.$product->slide[0]->name) }}"
                                     class="img-fluid z-depth-1">
                            </figure>

                        </div>

                        <div class="col-12">
                            <div class="row">
                                @foreach ($product->slide as $img)
                                    <div class="col-3">
                                        <div class="view overlay rounded z-depth-1 gallery-item">
                                            <img src="{{ asset('storage/uploads/products/'.$img->name) }}"
                                                 class="img-fluid imgSlide"
                                                 data-img="{{ asset('storage/uploads/products/'.$img->name) }}">
                                            <div class="mask rgba-white-slight"></div>
                                        </div>
                                    </div>
                                @endforeach


                            </div>
                        </div>

                    </div>

                </div>
                <div class="col-md-6">

                    <h5>{{$product->name}}</h5>
                    <p class="mb-2 text-muted text-uppercase small">{{$product->BrandInfo->name}}</p>

                    <p><span class="mr-1"><strong>{{$product->price}}</strong></span></p>

                    <p class="pt-1">{{$product->description}}</p>

                    <hr>
                    <form action="{{ route('addToCart') }}" id="tmtAddPdtForm" method="post" >
                        @csrf
                        <div class="table-responsive mb-2">
                            <table class="table table-sm table-borderless">
                                <tbody>
                                <tr>
                                    <td class="pl-0 pb-0 w-25">Quantity</td>
                                    <td>
                                        <div class="def-number-input number-input safari_only mb-0">
                                            <button type="button"
                                                onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                                <i class="fas fa-minus"></i></button>
                                            <input class="quantity" min="0" name="quantity" id="pdtQuantity" value="1" type="number">
                                            <button type="button"
                                                onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                                <i class="fas fa-plus"></i></button>
                                        </div>

                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <button type="submit" class="btn btn-primary btn-md mr-1 mb-2"><i
                                class="fas fa-shopping-cart pr-2" id="tmtAdd" ></i>Add to cart
                        </button>
                        <input type="hidden" id="pdtId" value="{{ $product->id }}">
                        <input type="hidden" id="order" value="{{ $order->id ?? 0 }}">
                    </form>
                </div>
            </div>

        </section>
        <!--Section: Block Content-->
    </div>

@endsection

@section('scripts')
<script src="{{ asset('js/cart.js') }}"></script>
@endsection
