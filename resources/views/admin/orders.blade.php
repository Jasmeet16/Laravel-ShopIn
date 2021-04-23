@extends('admin.layout')

@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        <div class="container">
            <ul class="list-group">
                <li class="list-group-item">
                    <p class="d-flex justify-content-between">
                        <span>Order id</span>
                        <span>product_id</span>
                        <span>qty</span>
                        <span>status</span>

                        <span> Action </span>
                        <span>created_at</span>
                    </p>
                </li>
                @foreach ($orders as $order)
                    {{-- {{ $order }} --}}
                    <li class="list-group-item">
                        <div class="d-flex justify-content-between">
                            <div>{{ $order->id }}</div>
                            <div>{{ $order->product_id }}</div>
                            <div>{{ $order->qty }}</div>
                           
                                <select name="status" class="status" id="{{ $order->id }}">
                                    <option value="0" hidden> Change Status </option>
                                    <option value="1"> Pending </option>
                                    <option value="2"> Confirmed </option>
                                    <option value="3"> Dispatched </option>
                                    <option value="4"> Delivered </option>
                                </select>
                            
                            @if ($order->status == 'Confirmed')
                                <div class="alert alert-success" id="status{{ $order->id }}">
                                    {{ $order->status }}
                                </div>
                            @elseif( $order->status =='Dispatched' )
                                <div class="alert alert-warning" id="status{{ $order->id }}">
                                    {{ $order->status }}
                                </div>
                            @elseif ($order->status = 'Delivered')
                                <div class="alert alert-info" id="status{{ $order->id }}">
                                    {{ $order->status }}
                                </div>
                                @elseif ($order->status = 'Pending')
                                <div class="alert alert-danger" id="status{{ $order->id }}">
                                    {{ $order->status }}
                                </div>
                            @endif


                            <div>{{ $order->created_at }}</div>
                        </div>
                    </li>
                @endforeach()
            </ul>
        </div>
    </main>
    <script>
        $('.status').on('change', function(e) {

            let status = e.target.value;
            let orderId = e.target.id;
            $.ajax({
                url: `orders/status/${orderId}/${status}`,
                type: "GET",
                success: function(response) {
                    $(`#status${orderId}`).text(response);
                    if (response === 'Confirmed') {
                        document.getElementById(`status${orderId}`).className = "alert alert-success";
                    } else if (response === 'Dispatched') {
                        document.getElementById(`status${orderId}`).className = "alert alert-warning";
                    } else if (response === 'Delivered') {
                        document.getElementById(`status${orderId}`).className = "alert alert-info";
                    }else{
                        document.getElementById(`status${orderId}`).className = "alert alert-danger";
                    }
                }
            });
        });

    </script>
@endsection
