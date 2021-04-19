@extends('layouts.layout')
@inject('cart', 'App\Http\Controllers\CartController')
@section('content')
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <ul class="list-group py-3 cart-list">
                        <li class="py-3 list-group-item">
                            <h2> Shopping Cart </h2>
                        </li>
                        @if (count($products) == 0)
                            <div class="alert alert-danger"> Cart is empty</div>
                        @endif
                        @foreach ($products as $product)
                            {{-- {{ dd($product) }} --}}
                            <li class="py-3 list-group-item d-flex justify-content-between align-items-center cart"
                                id="{{ $product->get()[0]->id }}">

                                <img src="{{ $product->get()[0]->image }}" alt="prd-img" height="100" width="100">
                                <span>{{ $product->get()[0]->name }}</span>
                                <span> ₹ {{ $product->get()[0]->price }}</span>
                                <span id='qty-{{ $product->get()[0]->id }}'> Qty :
                                    {{ $cart->selectedQty($product->get()[0]->id) }}</span>
                                <form action="{{ url('cart/' . $product->get()[0]->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    <select class="form-control select-qty" name="qty">
                                        <option value="" selected disabled hidden>Change Qty</option>
                                        @for ($i = 1; $i <= $product->get()[0]->qty; $i++)
                                            <option value="{{ $i }}" id="{{ $product->get()[0]->id }}">
                                                {{ $i }}</option>
                                        @endfor

                                    </select>
                                </form>
                                <form class="delete-prod" action="{{ url('cart') }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <input type="hidden" class='prod_id' value="{{ $product->get()[0]->id }}">
                                    <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-md-1"></div>

                <div class="col-md-3">
                    <ul class="list-group py-3">
                        <li class="list-group-item text-center">
                            <ul class="list-group-flush p-2">
                                <li class="py-2 list-group-item">
                                    <span style="font-size:1rem"><strong id="total"> Cart Total : ₹ {{ $cart->total() }} </strong></span>
                                </li>
                                <li class="py-2 list-group-item">
                                    <span>GST : 18 % </span>
                                </li>
                                <li class="py-2 list-group-item">
                                    <span>Delivery Charges : ₹ 50 </span>
                                </li>
                                <li class="py-2 list-group-item">
                                    <h3 id="gross-total" style="font-size:1.5rem"> Gross Total : ₹
                                        {{ $cart->total() + $cart->total() * 0.18 + 50 }} </h3>
                                </li>
                            </ul>
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
                    success: function() {
                        $(`#${prod_id}`).remove();
                        $.ajax({
                            url: "/carttotal",
                            type: "GET",
                            data: {},
                            success: function(data) {
                                $(`#${prod_id}`).remove();
                                $(`#total`).text("Total : " + data);
                                let extraCharge = ((parseInt(data) * 18) / 100).toFixed(2);
                                //console.log( parseInt(data) + parseInt(extraCharge) + 50);
                                let grossTotal = parseInt(data) + parseInt(extraCharge) + 50;
                                $(`#gross-total`).text(`Gross Total : ₹` +grossTotal);
                            }
                        });
                    }
                });
            });
            $('.select-qty').on('change', function(e) {
                //e.preventDefault();


                let prod_id = $(this).children("option:selected")[0].id;
                let val = $(this).children("option:selected").val();

                $.ajax({
                    url: "/cart",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": prod_id,
                        "qty": val
                    },
                    success: function() {
                        $(`#qty-${prod_id}`).text("Qty : " + val);
                        $.ajax({
                            url: "/carttotal",
                            type: "GET",
                            data: {},
                            success: function(data) {
                                $(`#total`).text("Total : " + data);


                                let extraCharge = ((parseInt(data) * 18) / 100)
                                    .toFixed(2);
                                //console.log( parseInt(data) + parseInt(extraCharge) + 50);
                                let grossTotal = parseInt(data) + parseInt(
                                    extraCharge) + 50;
                                $(`#gross-total`).text(`Gross Total : ₹` +
                                    grossTotal);
                            }
                        });
                    }

                });
            });
        })

    </script>
@endsection
