@extends('layouts.layout')


@section('content')

    <div class="album py-5 bg-light">

        <div class="container">

            <h3 class='mb-5'>Products Here</h3>
            <div class="row">
                @foreach ($products->all() as $product)
                    <div class="col-md-4">
                        <div class="card mb-4 box-shadow">
                            <a href=" products/{{ $product->id }}">
                                <img class="card-img-top" src="{{ url($product->image) }}" alt="product-image">
                            </a>
                            <div class="card-body">
                                <h3 class="card-text">{{ $product->name }}</h3>
                                @if ( Auth::user() )
                                    
                                @else
                                    
                                @endif

                                <div class="d-flex justify-content-between align-items-center">
                                    <form action="products/cart/{{ $product->id }}" class='w-50' method="POST">
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-outline-secondary w-100">
                                            Add To Cart
                                        </button>
                                    </form>

                                    <button type="button" class="btn btn-outline-secondary w-50">Buy Now</button>
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
