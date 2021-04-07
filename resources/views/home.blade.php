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
                                
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary">
                                            Add To Cart
                                        </button>
                                        <button type="button" class="btn btn-sm btn-outline-secondary">Buy Now</button>
                                    </div>
                                    <small class="text-muted"> </small>
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach
            </div>
        </div>
    </div>
@endsection
