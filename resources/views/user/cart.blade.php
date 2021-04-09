@extends('layouts.layout')

@section('content')
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <ul class="list-group py-3">
                        <li class="py-3 list-group-item">
                            <h2> Shopping Cart </h2>
                        </li>
                        
                        @foreach ($products as $product)
                            <li class="py-3 list-group-item">
                                <img src="{{$product->get()[0]->image}}" alt="prd-img" height="100" width="100">
                                <span>{{ $product->get()[0]->name }}</span>
                                <span>{{ $product->get()[0]->price }}</span>

                            </li>
                        @endforeach

                    </ul>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-3">
                    <ul class="list-group py-3">
                        <li class="py-3 list-group-item">
                            <h3> Total </h3>
                        </li>
                    </ul>

                </div>

            </div>
        </div>
    </div>
@endsection
