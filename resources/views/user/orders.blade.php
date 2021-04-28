@extends( 'layouts.layout' )
@inject('cart', 'App\Http\Controllers\CartController')
@section('content')

    <div class="album py-5 bg-light">
        <div class="container">
            <h2 class='mb-5'>My Orders</h2>
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr class="align-self-center">
                                <td> <img src="{{ $cart->getProduct($order->product_id)->image }}" alt="thumbnail"
                                        height="150px" width="150px"> </td>
                                <td>{{ $cart->getProduct($order->product_id)->name }}</td>
                                <td>{{ $cart->getProduct($order->product_id)->price }}</td>
                                <td>{{ $order->qty }}</td>
                                <td>
                                    @if ($order->status == 'Confirmed')
                                        <div class="alert alert-success" style="width:40%" id="status{{ $order->id }}">
                                            {{ $order->status }}
                                        </div>
                                    @elseif( $order->status =='Dispatched' )
                                        <div class="alert alert-warning" style="width:40%" id="status{{ $order->id }}">
                                            {{ $order->status }}
                                        </div>
                                    @elseif ($order->status == 'Delivered')
                                        <div class="alert alert-info" style="width:40%" id="status{{ $order->id }}">
                                            {{ $order->status }}
                                        </div>
                                    @elseif ($order->status == 'pending')
                                        <div class="alert alert-danger" style="width:40%" id="status{{ $order->id }}">
                                            {{ $order->status }}
                                        </div>
                                    @endif
                                </td>

                            </tr>
                        @endforeach()
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
