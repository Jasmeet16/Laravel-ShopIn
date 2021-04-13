@extends('layouts.layout')
@inject('cart', 'App\Http\Controllers\CartController')
@section('content')
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <ul class="list-group py-3">
                        <li class="py-3 list-group-item">
                            <h2> Delivering To </h2>
                        </li>
                        <li class="py-3 list-group-item">
                            <p><strong>Name : </strong> {{ Auth::user()->profile()->get()[0]->name }} </p>
                            <p><strong>Contact No. : </strong> {{ Auth::user()->profile()->get()[0]->phone }} </p>
                            <p><strong>Address : </strong> {{ Auth::user()->profile()->get()[0]->address }} </p>
                        </li>
                    </ul>
                    <ul class="list-group py-3">
                        <li class="py-3 list-group-item">
                            <h2> Order Summary </h2>
                        </li>
                        @foreach (Auth::user()->cart()->get() as $item)
                        <li class="py-3 list-group-item d-flex justify-content-between align-items-center">
                            <img src="{{$cart->getProduct($item->product_id)[0]->image}}" alt="prd-img" height="100" width="100">
                                <span>{{ $cart->getProduct($item->product_id)[0]->name }}</span>
                                <span> ₹ {{ $cart->getProduct($item->product_id)[0]->price }}</span>
                                <span> Qty : {{ $item->qty  }}</span>
                            </li>
                        @endforeach
                    </ul>
                    
                </div>
                <div class="col-md-1"></div>

                <div class="col-md-5">
                    <ul class="list-group py-3">
                        <li class="py-3 list-group-item">
                            <h3> Total : ₹ {{ $cart->total() }}</h3>

                        </li>
                        <li class="py-3 list-group-item">
                            <strong style="font-size: 1.5rem">Select Mode of Payment</strong>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
                                <label class="custom-control-label" for="customRadio1">Cash On Delivery</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
                                <label class="custom-control-label" for="customRadio2">Portal</label>
                            </div>
                        </li>
                        <li class="py-3 list-group-item">
                            <form action="/orders" method="POST">
                                {{ csrf_field() }}
                                <button class="btn btn-dark w-100 py-3" type="submit"  > Proceed</button>
                            </form>
                             
                            
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
