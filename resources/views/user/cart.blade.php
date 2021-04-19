@extends('layouts.layout')
@inject('cart', 'App\Http\Controllers\CartController')
@section('content')
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <ul class="list-group py-3 cart-list">
                        <li class="py-3 list-group-item">
                            <h2> Shopping Cart </h2>
                        </li>
                        @if (count($products) == 0)
                            <div class="alert alert-danger"> Cart is empty</div>
                        @endif
                        @foreach ($products as $product)
                            {{-- {{ dd($product) }} --}}
                            <li class="py-3 list-group-item d-flex justify-content-between align-items-center cart" id="{{ $product->get()[0]->id }}">

                                <img src="{{ $product->get()[0]->image }}" alt="prd-img" height="100" width="100">
                                <span>{{ $product->get()[0]->name }}</span>
                                <span> ₹ {{ $product->get()[0]->price }}</span>
                                <span id='qty-{{$product->get()[0]->id}}'> Qty : {{ $cart->selectedQty($product->get()[0]->id) }}</span>
                                {{-- {{$product->get()[0]->id}} --}}
                                {{-- {{$product->get()[0]}} --}}
                                <form action="{{ url('cart/' . $product->get()[0]->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    <select class="form-control select-qty"  name="qty">
                                        <option value="" selected disabled hidden>Change Qty</option>
                                        @for ($i = 1; $i <= $product->get()[0]->qty; $i++)
                                            <option value="{{ $i }}" id="{{ $product->get()[0]->id }}">{{ $i }}</option>
                                        @endfor

                                    </select>
                                </form>
                                <form class="delete-prod" action="{{ url('cart') }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <input type="hidden"  class='prod_id' value="{{ $product->get()[0]->id }}">
                                    <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-md-1"></div>

                <div class="col-md-2">
                    <ul class="list-group py-3">
                        <li class="py-3 list-group-item">
                            <h3> Total : ₹ {{ $cart->total() }} </h3>

                        </li>
                        <li class="py-3 list-group-item">
                            <a type="button" class="btn btn-dark w-100 py-3 <?php if ($cart->total() == 0) {
                                    echo 'disabled';
                                } ?>" href="{{ url('/cart/checkout/profile') }}">Proceed</a>
                        </li>
                    </ul>
                    <ul class="list-group py-3">
                        <li class="py-3 list-group-item">
                            <a type="button" class="btn btn-dark w-100 py-3" href="{{ url('/orders') }}">MyOrders</a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.delete-prod').on('submit', function(e) {
                e.preventDefault();

                console.log(e.target.children[2].value);
                let prod_id = e.target.children[2].value;

                $.ajax({
                    url: "/cart",
                    type: "DELETE",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": prod_id
                    },
                    success:function(){
                        $(`#${prod_id}`).remove();
                    }
                });
            });
            $('.select-qty').on('change', function(e) {
                //e.preventDefault();

                console.log($(this).children("option:selected")[0].id);


                let prod_id = $(this).children("option:selected")[0].id;
                let val = $(this).children("option:selected").val();

                $.ajax({
                    url: "/cart",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": prod_id,
                        "qty" : val
                    },
                    success:function(){
                        $(`#qty-${prod_id}`).text( "Qty : " + val);
                    }
                    
                });
            });
        })

    </script>
@endsection
