<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Titops') }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/cart/cart.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Front Page') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a id="cartDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fas fa-shopping-cart"></i>
                                    Your Cart
                                    @if( isset($order->items) && count($order->items) > 0 )
                                        <span class="badge" id="cartCount" >{{count($order->items)}}</span>
                                    @endif
                                </a>

                                <div class="dropdown-menu dropdown-menu-right p-2" aria-labelledby="cartDropdown" id="cartContent" >
                                    @if (empty($order) )
                                    <p>No item in your cart</p>
                                    <p>Please add new item</p>

                                    @else
                                        <div class="container">
                                            <div class="shopping-cart" id="shpCart">
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

{{--                                                <a href="#" class="button">Checkout</a>--}}
                                            </div> <!--end shopping-cart -->
                                        </div> <!--end container -->
                                    @endif
                                </div>
                            </li>

                        @endguest

                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    <script>
        var appToken = '{{ csrf_token() }}';
    </script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    @yield('scripts')
</body>
</html>
