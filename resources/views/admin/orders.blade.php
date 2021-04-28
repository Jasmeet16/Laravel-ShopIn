@extends('admin.layout')

@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        <div class="container">
            <table class="table table-hover table-bordered">
                <thead class="table-dark">
                    <thead class="table-dark">
                        <tr>
                            <th class='text-center'>
                                <h6> Order Id </h6>
                            </th>
                            <th class='text-center'>
                                <h6> Product Id </h6>
                            </th>
                            <th class='text-center'>
                                <h6> Quantity </h6>
                            </th>
                            <th class='text-center'>
                                <h6> Options </h6>
                            </th>
                            <th class='text-center'>
                                <h6>  Status</h6>
                            </th>
                            <th class='text-center'>
                                <h6> Created_at </h6>
                            </th>

                        </tr>
                    </thead>
                    @foreach ($orders as $order)
                        {{-- {{ $order }} --}}
                        <tr>
                            <td class='text-center'>{{ $order->id }}</td>
                            <td class='text-center'>{{ $order->product_id }}</td>
                            <td class='text-center'>{{ $order->qty }}</td>
                            <td class='text-center'>
                                <select name="status" class="status" id="{{ $order->id }}">
                                    <option value="0" hidden> Change Status </option>
                                    <option value="1"> Pending </option>
                                    <option value="2"> Confirmed </option>
                                    <option value="3"> Dispatched </option>
                                    <option value="4"> Delivered </option>
                                </select>
                            </td>
                            <td class='text-center'>
                                @if ($order->status == 'Confirmed')
                                    <div class="alert alert-success" id="status{{ $order->id }}">
                                        {{ $order->status }}
                                    </div>
                                @elseif( $order->status =='Dispatched' )
                                    <div class="alert alert-warning" id="status{{ $order->id }}">
                                        {{ $order->status }}
                                    </div>
                                @elseif ($order->status == 'Delivered')
                                    <div class="alert alert-info" id="status{{ $order->id }}">
                                        {{ $order->status }}
                                    </div>
                                @elseif ($order->status == 'pending')
                                    <div class="alert alert-danger" id="status{{ $order->id }}">
                                        {{ $order->status }}
                                    </div>
                                @endif
                            </td>
                            <td class='text-center'>{{ $order->created_at }}</td>
                        </tr>
                    @endforeach()
            </table>
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
                    } else {
                        document.getElementById(`status${orderId}`).className = "alert alert-danger";
                    }
                }
            });
        });

    </script>
@endsection

@section('footer')
    {{ $orders->links() }}
@endsection
