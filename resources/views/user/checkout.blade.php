@extends('layouts.layout')

@section('content')
    <div class="album py-5 bg-light">
        <div class="container">
            @include('error')
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
                        @foreach ($cart as $item)
                        <li class="py-3 list-group-item d-flex justify-content-between align-items-center">
                            <img src="{{$item->image}}" alt="prd-img" height="100" width="100">
                                <span>{{ $item->name }}</span>
                                <span> ₹ {{ $item->price }}</span>
                                <span> Qty : {{ $item->cartquantity  }}</span>
                            </li>
                        @endforeach
                    </ul>
                    
                </div>
                <div class="col-md-1"></div>

                <div class="col-md-5">
                    <ul class="list-group py-3">
                        <li class="py-3 list-group-item">
                            <h3> Amount : ₹ {{ $total + ( $total * 0.18 ) + 50 }}</h3>

                        </li>
                        <li class="py-3 list-group-item">
                            <h3><strong class="py-3" style="font-size: 1.5rem">Select Mode of Payment</strong></h3>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
                                <label class="custom-control-label p-2" for="customRadio1">Cash On Delivery</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="customRadio2 " name="customRadio" class="custom-control-input">
                                <label class="custom-control-label p-2" for="customRadio2">Portal</label>
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
