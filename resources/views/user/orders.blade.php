@extends( 'layouts.layout' )

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
                                <td> <img src="{{ $order->image }}" alt="thumbnail"
                                        height="150px" width="150px"> </td>
                                <td>{{ $order->name }}</td>
                                <td>{{ $order->price }}</td>
                                <td>{{ $order->orderqty }}</td>
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
                                    @elseif ($order->status == 'Pending')
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
