@extends('admin.layout')
@section('content')
    <main role="main" class="col-md-9">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <ul class="list-group py-3">
                        <li class="py-3 list-group-item">
                            <h2> Orders Placed </h2>
                        </li>
                        @if ($orders->isEmpty())
                            <div class="alert alert-info">
                                <h5>User has never placed an Order</h5>
                            </div>
                        @else
                            @foreach ($orders as $order)
                                <li class="py-3 list-group-item  d-flex justify-content-between">
                                    <p><strong> Order Id : </strong> {{ $order->id }} </p>
                                    <p><strong>Product Id. : </strong> {{ $order->product_id }} </p>
                                    <p><strong>Name : </strong> {{ $order->product->name }} </p>
                                    <p><strong>Qty : </strong> {{ $order->qty }} </p>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-3">
                    <ul class="list-group py-3">
                        <li class="py-3 list-group-item">
                            <h3> User Details </h3>
                        </li>
                        @if ($orders->isEmpty())
                            <li class="py-3 list-group-item">
                                <strong>Email : </strong> {{ $user->email }}
                            </li>
                        @else
                            <li class="py-3 list-group-item">
                                <strong>Email : </strong> {{ $user->email }}
                            </li>
                            <li class="py-3 list-group-item">
                                <strong>Name : </strong> {{ $profile[0]->name }}
                            </li>
                            <li class="py-3 list-group-item">
                                <strong>Phone : </strong> {{ $profile[0]->phone }}
                            </li>
                            <li class="py-3 list-group-item">
                                <strong>Address : </strong> {{ $profile[0]->address }}
                            </li>
                        @endif

                    </ul>
                </div>
            </div>
        </div>
    </main>
@endsection
