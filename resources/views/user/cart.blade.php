@extends('layouts.layout')
@inject('cart', 'App\Http\Controllers\CartController')
@section('content')
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <ul class="list-group py-3">
                        <li class="py-3 list-group-item">
                            <h2> Shopping Cart </h2>
                        </li>
                        @if (count($products) == 0)
                        <div class="alert alert-danger"> Cart is empty</div>
                        @endif
                        @foreach ($products as $product)
                        {{-- {{ dd($product) }} --}}
                            <li class="py-3 list-group-item d-flex justify-content-between align-items-center">
                                
                                <img src="{{$product->get()[0]->image}}" alt="prd-img" height="100" width="100">
                                <span>{{ $product->get()[0]->name }}</span>
                                <span> ₹ {{ $product->get()[0]->price }}</span>
                                <span> Qty : {{ $cart->selectedQty( $product->get()[0]->id ) }}</span>
                                {{-- {{$product->get()[0]->id}} --}}
                                {{-- {{$product->get()[0]}} --}}
                                <form action="{{url('cart/' . $product->get()[0]->id)}}" method="POST">
                                    {{ csrf_field() }}
                                    <select class="form-control" onchange="this.form.submit()" name="qty">
                                        <option value="" selected disabled hidden>Change Qty</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                      </select>
                                </form>
                                <form action="{{url('cart/' . $product->get()[0]->id)}}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                  <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-md-1"></div>
                
                <div class="col-md-2">
                    <ul class="list-group py-3">
                        <li class="py-3 list-group-item">
                            <h3> Total : ₹ {{ $cart->total() }} </h3>
                            
                        </li>
                        <li class="py-3 list-group-item">
                            <a type="button" class="btn btn-dark w-100 py-3 <?php if( $cart->total() == 0 ) echo 'disabled'; ?>" href="{{url('/cart/checkout/profile')}}"  >Proceed</a>
                        </li>
                    </ul>
                    <ul class="list-group py-3">
                        <li class="py-3 list-group-item">
                            <a type="button" class="btn btn-dark w-100 py-3" href="{{url('/orders')}}">MyOrders</a>
                        </li>
                        
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection