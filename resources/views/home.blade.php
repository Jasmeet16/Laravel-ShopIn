@extends('layouts.layout')

@inject('cart', 'App\Http\Controllers\CartController')
@section('content')

    <div class="album py-5 bg-light">

        <div class="container">

            <h3 class='mb-5'>Products Here</h3>
            @if (\Session::has('success'))
                <div class="alert alert-info">{!! \Session::get('success') !!}</div>
            @endif
            <div class="row">
                @foreach ($products->all() as $product)
                    <div class="col-md-4">
                        <div class="card mb-4 box-shadow">
                            <a href=" products/{{ $product->id }}">
                                <img class="card-img-top" src="{{ url($product->image) }}" alt="product-image">
                            </a>
                            <div class="card-body">
                                <h3 class="card-text">{{ $product->name }}</h3>

                                <div class="d-flex justify-content-between align-items-center">
                                    @if (!Auth::guest() && $cart->inCart($product->id))
                                        <button class='btn btn-outline-secondary w-100' type="submit" disabled>Product
                                            Already
                                            Present in Cart</button>
                                    @else
                                        <form action="{{ url('products/cart/' . $product->id) }}" class="w-50" method="POST">
                                            {{ csrf_field() }}
                                            <button class='btn btn-outline-secondary w-100' type="submit">Add To
                                                Cart</button>
                                        </form>
                                    @endif


                                    <a href="{{ url('products/' . $product->id) }}" type="button"
                                        class="btn btn-outline-secondary w-50">View Product</a>
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach

            </div>

        </div>
    </div>
@endsection

@section('footer')
    {{ $products->links() }}
@endsection
