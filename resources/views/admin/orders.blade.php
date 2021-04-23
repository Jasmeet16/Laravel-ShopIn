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
                        <p class="d-flex justify-content-between">
                            <span>{{ $order->id }}</span>
                            <span>{{ $order->product_id }}</span>
                            <span>{{ $order->qty }}</span>
                            <span>{{ $order->status }}</span>

                            <span>
                                <select name="status" id="status">
                                    <option value="1"> Pending </option>
                                    <option value="2"> Confirmed </option>
                                    <option value="3"> Dispatched </option>
                                    <option value="4"> Delivered </option>
                                </select>
                            </span>
                            <span>{{ $order->created_at }}</span>
                        </p>
                    </li>
                @endforeach()
            </ul>
        </div>
    </main>
    <script>
        
    </script>
@endsection
