@extends('layouts.app')

@section('content')
<div class="container">
    <!--Section: Block Content-->
<section class="mb-5">

    <div class="row">
      <div class="col-md-6 mb-4 mb-md-0">
        <div class="row product-gallery mx-1">
  
            <figure class="view main-img">
                <img src="{{ asset('storage/uploads/products/'.$product->images) }}"
                    class="img-fluid z-depth-1">
              </figure>
          </div>
  
      </div>
      <div class="col-md-6">
  
        <h5>{{$product->name}}</h5>
        <p class="mb-2 text-muted text-uppercase small">{{$product->BrandInfo->name}}</p>
        
        <p><span class="mr-1"><strong>{{$product->price}}</strong></span></p>
        
        <p class="pt-1">{{$product->description}}</p>

        <hr>
        <div class="table-responsive mb-2">
          <table class="table table-sm table-borderless">
            <tbody>
              <tr>
                <td class="pl-0 pb-0 w-25">Quantity</td>
                <td>
                    <div class="def-number-input number-input safari_only mb-0">
                        <button onclick="this.parentNode.querySelector('input[type=number]').stepDown()" ><i class="fas fa-minus"></i></button>
                        <input class="quantity" min="0" name="quantity" value="1" type="number">
                        <button onclick="this.parentNode.querySelector('input[type=number]').stepUp()" ><i class="fas fa-plus"></i></button>
                    </div>

                </td>
              </tr>
            </tbody>
          </table>
        </div>
        
        <button type="button" class="btn btn-primary btn-md mr-1 mb-2"><i
            class="fas fa-shopping-cart pr-2"></i>Add to cart</button>
      </div>
    </div>
  
</section>
<!--Section: Block Content-->
</div>

@endsection