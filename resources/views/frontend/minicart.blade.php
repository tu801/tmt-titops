<div class="shopping-cart-header">
    <i class="fa fa-shopping-cart cart-icon"></i><span class="badge">{{count($order->items)}}</span>
    <div class="shopping-cart-total">
        <span class="lighter-text">Total:</span>
        <span class="main-color-text">${{ number_format($order->total, 2) }}</span>
    </div>
</div> <!--end shopping-cart-header -->

<ul class="shopping-cart-items">
    @foreach($order->items as $item)
    <li class="clearfix">
        <img src="{{ asset('storage/uploads/products/'.$item->image) }}" alt="{{ $item->name  }}" width="70px" height="70px" />
        <span class="item-name">{{ $item->name  }}</span>
        <span class="item-price">${{ number_format($item->price,2)  }}</span>
        <span class="item-quantity">Quantity: {{ $item->quantity }}</span>
    </li>
    @endforeach

</ul>
