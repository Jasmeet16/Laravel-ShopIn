@extends('layouts.layout')
@inject('cart', 'App\Http\Controllers\CartController')
@section('content')

    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="row py-3 prod-img">
                        <img src="{{ $product->image }}" alt="{{ $product->name }}" style='height: 100%; width: 100%;'>
                    </div>
                    <div class="row my-3">
                        <div class="col-md-6">
                            <button class='btn btn-dark w-100 py-3'> Buy Now </button>
                        </div>
                        <div class="col-md-6">
                            @if (!Auth::guest() && $cart->inCart($product->id))
                                <button class='btn btn-dark w-100 py-3' type="submit" disabled>Product Already Present in
                                    Cart</button>
                            @elseif ( !Auth::guest() && $product->qty <= 0)<button
                                    class='btn btn-dark w-100 py-3' type="submit" disabled>Product
                                    Out of Stock
                                    </button>
                                @else

                                    <form action="cart/{{ $product->id }}" id="add-cart" method="POST">
                                        {{ csrf_field() }}
                                        <button class='btn btn-dark w-100 py-3' type="submit">Add To Cart</button>
                                    </form>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-5 text-right">
                    <ul class="list-group py-3">
                        <li class="py-3 list-group-item">
                            <h3> {{ $product->name }} </h3>
                        </li>
                        <li class="py-3 list-group-item">
                            <span> <strong> Price : </strong> </span>
                            <span> ₹ {{ $product->price }} </span>
                        </li>
                        <li class="py-3 list-group-item">
                            <span> <strong> Number of items in stock : </strong> </span>
                            <span> {{ $product->qty }} </span>
                        </li>
                        <li class="py-3 list-group-item">
                            <p> <strong> Description </strong> </p>
                            <p> {{ $product->description }} </p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    {{-- <script type="text/javascript">
        $('#add-cart').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: "cart/{{ $product->id }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}"
                }
            });
        });
    </script> --}}
@endsection
