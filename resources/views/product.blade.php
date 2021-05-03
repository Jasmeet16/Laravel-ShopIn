@extends('layouts.layout')

@section('content')
    
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="row py-3 prod-img" style="margin: auto">
                        <img src="{{ $product->image }}" alt="{{ $product->name }}">
                    </div>
                    <div class="row my-3">
                        <div class="col-md-6">
                            @if (!Auth::guest() && $product->incart)
                                <button class='btn btn-dark w-100 py-3' id="cart-btn" type="submit" disabled>Go to
                                    Cart</button>

                            @elseif ( !Auth::guest() && $product->qty <= 0)<button class='btn btn-dark w-100 py-3'
                                    id="cart-btn" type="submit" disabled>Product
                                    Out of Stock
                                    </button>
                                @else
                                    <form action="{{ url('products/cart') }}" method="POST">
                                        {{ csrf_field() }}
                                        <input type="hidden" class='prod_id' name="id" value="{{ $product->id }}">
                                        <button class='btn btn-dark w-100 py-3' id="buy-now" type="submit"> <i
                                                class="fas fa-bolt mr-5"></i> Buy Now </button>
                                    </form>
                            @endif

                        </div>
                        <div class="col-md-6">
                            @if (!Auth::guest() &&  $product->incart)
                                <button class='btn btn-dark w-100 py-3' id="cart-btn" type="submit" disabled>Product Already
                                    Present in
                                    Cart</button>
                            @elseif ( !Auth::guest() && $product->qty <= 0)<button class='btn btn-dark w-100 py-3'
                                    id="cart-btn" type="submit" disabled>Product
                                    Out of Stock
                                    </button>
                                @else

                                    <form class="add-cart" action="{{ url('products/cart') }}" method="POST">
                                        {{ csrf_field() }}
                                        <input type="hidden" class='prod_id' value="{{ $product->id }}">
                                        <button class='btn btn-dark w-100 py-3' id="cart-btn" type="submit"><i
                                                class="fas fa-shopping-cart mr-5"></i>Add To
                                            Cart</button>
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
    <script type="text/javascript">
        $('.add-cart').on('submit', function(e) {
            e.preventDefault();

            //console.log(e.target);
            let prodId = e.target.childNodes[3].value;
            console.log(prodId);
            $.ajax({
                url: "cart",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": prodId
                },
                success: function() {
                    $('#cart-btn').text('Product Added');
                    $("#buy-now").prop({
                        disabled: true
                    });
                    document.getElementById(`cart-btn`).disabled = true;
                },
                error: function() {
                    alert('You must be logged in');
                }
            })
        })

    </script>
@endsection
