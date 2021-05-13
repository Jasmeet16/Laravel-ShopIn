@extends('layouts.layout')

@section('content')

    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <ul class="list-group py-3 cart-list">
                        <li class="py-3 list-group-item">
                            <h2> Shopping Cart </h2>
                        </li>
                        @if (count($items) == 0)
                            <div class="alert alert-danger"> Cart is empty</div>
                        @endif
                        @foreach ($items as $item)

                            <li class="py-3 list-group-item d-flex justify-content-between align-items-center cart"
                                id="{{ $item->product_id }}">

                                <img src="{{ $item->image }}" alt="prd-img" height="100" width="100">
                                <span>{{ $item->name }}</span>
                                <span> ₹ {{ $item->price }}</span>
                                <span id='qty-{{ $item->product_id }}'> Qty :
                                    {{ $item->cartquantity }}</span>
                                <form action="{{ url('cart/' . $item->product_id) }}" method="POST">
                                    {{ csrf_field() }}
                                    <select class="form-control select-qty" name="qty">
                                        <option value="" selected disabled hidden>Change Qty</option>
                                        @for ($i = 1; $i <= $item->qty; $i++)
                                            <option value="{{ $i }}" id="{{ $item->product_id }}">
                                                {{ $i }}</option>
                                        @endfor

                                    </select>
                                </form>
                                <form class="delete-prod" action="{{ url('cart') }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <input type="hidden" class='prod_id' value="{{ $item->product_id }}">
                                    <button class="btn btn-danger btn-sm" type="submit"><i
                                            class="far fa-trash-alt"></i></button>
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
                                    <span style="font-size:1rem"><strong id="total"> Cart Total : ₹ {{ $total }}
                                        </strong></span>
                                </li>
                                <li class="py-2 list-group-item">
                                    <span>GST : 18 % </span>
                                </li>
                                <li class="py-2 list-group-item">
                                    <span>Delivery Charges : ₹ 50 </span>
                                </li>
                                <li class="py-2 list-group-item">
                                    <h3 id="gross-total" style="font-size:1.5rem"> Gross Total : ₹
                                        {{ $total + $total * 0.18 + 50 }} </h3>
                                </li>
                            </ul>
                        </li>
                        <li class="py-3 list-group-item">
                            <a type="button" id="proceed" class="btn btn-dark w-100 py-3 <?php if ($total == 0) {
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
                                let extraCharge = ((parseInt(data) * 18) / 100)
                                    .toFixed(2);
                                //console.log( parseInt(data) + parseInt(extraCharge) + 50);
                                let grossTotal = parseInt(data) + parseInt(
                                    extraCharge) + 50;
                                $(`#gross-total`).text(`Gross Total : ₹` +
                                    grossTotal);
                                if (data == 0) {
                                    console.log( document.getElementById(`proceed`));
                                }
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
                    success: function(response) {
                        if (response.updated) {
                            $(`#qty-${prod_id}`).text("Qty : " + response.state);
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
                        } else {
                            alert(response.state);
                        }

                    }

                });
            });
        })

    </script>
@endsection
