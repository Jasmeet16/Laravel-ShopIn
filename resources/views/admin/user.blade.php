@extends('admin.layout')

@section('content')
    <main role="main" class="col-md-9">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <ul class="list-group py-3">
                        <li class="py-3 list-group-item">
                            <h2> Orders Placed </h2>
                        </li>
                        @foreach ( $orders as $order )
                        <li class="py-3 list-group-item">
                            
                            <p><strong> Id : </strong> {{ $order->id }} </p>
                            <p><strong>Product No. : </strong>  {{ $order->product_id }} </p>
                            <p><strong>Qty : </strong>  {{ $order->qty }} </p>
                       
                        </li>
                        @endforeach
                        
                    </ul>
                </div>
                <div class="col-md-1"></div>

                <div class="col-md-2">
                    <ul class="list-group py-3">
                        <li class="py-3 list-group-item">
                            <h3> User Details </h3>
                        </li>
                        <li class="py-3 list-group-item">
                            {{ $user->email }}
                             
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </main>
@endsection
