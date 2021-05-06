@extends( 'layouts.layout' )

@section('content')

    <div class="album py-5 bg-light">
        <div class="container">

            <h1 class="text-center alert alert-success" type="alert">Congratulations! You have successfully placed your order </h1>
            <ul class="list-group py-3">
                <li class="py-3 list-group-item">
                    <h2> Order Summary </h2>
                </li>
                @foreach ($orders as $order)
                <li class="py-3 list-group-item d-flex justify-content-between align-items-center">
                        <span> <strong> Order Id :</strong>  {{ $order->id }}</span>
                        <span> <strong> Product Id :</strong> {{ $order->product_id }}</span>
                        <span> <strong> Quantity :</strong>  {{ $order->qty  }}</span>
                    </li>
                @endforeach
               
            </ul>
        </div>
    </div>
@endsection
