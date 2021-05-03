@extends('layouts.layout')

@section('content')
    <div class="album py-5 bg-light">
        <div class="container">


            @if ($products->currentPage() == 1)
                @include('crousel')
            @endif

            @if (\Session::has('success'))
                <div class="alert alert-info">{!! \Session::get('success') !!}</div>
            @endif

            <div class="alert alert-info success-message" style="display: none">Product added to Cart</div>
            <div class="row">

                @foreach ($products as $product)
                
                    <div class="col-md-4" style="margin: auto">
                        <div class="card h-100 mb-4 m-2 box-shadow ">
                            <a href=" products/{{ $product->id }}">
                                <img class="card-img-top img-fluid" src="{{ url($product->image) }}" alt="product-image">
                            </a>
                            <div class="card-body">
                               
                                    <h3 class="card-text">{{ $product->name }}</h3>
                                    <h6 class="card-text "> ₹ {{ $product->price }}</h6>
                                
                                <div class="d-flex justify-content-between align-items-center buttons">
                                    @if (!Auth::guest() && $product->incart)
                                        <button class='btn btn-outline-secondary w-75' type="submit" disabled>
                                            In Cart</button>
                                    @elseif ( $product->qty <= 0) <button class='btn btn-outline-secondary w-75'
                                            type="submit" disabled>
                                            Out of Stock
                                            </button>
                                        @else
                                            <form class='add-cart w-50' action="{{ url('products/cart') }}" method="POST">
                                                {{ csrf_field() }}
                                                <input type="hidden" class='prod_id' value="{{ $product->id }}">
                                                <button class='btn btn-outline-secondary w-100' id="{{ $product->id }}"
                                                    type="submit">
                                                    <i class="fas fa-shopping-cart"></i> Add To Cart</button>
                                            </form>
                                    @endif
                                    <a href="{{ url('products/' . $product->id) }}" type="button"
                                        class="btn btn-outline-secondary w-50"><i class="far fa-eye"></i>View
                                        Product</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    <script>
        $('.add-cart').on('submit', function(e) {
            e.preventDefault();
            let prodId = e.target.childNodes[3].value;
            $.ajax({
                url: "products/cart",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": prodId
                },
                success: function(data) {
                    document.getElementById(`${prodId}`).disabled = true;
                    $(`#${prodId}`).text('Product Added');

                },
                error: function() {
                    alert('You must be logged in');
                }
            })
        })

    </script>

@endsection
@section('footer')
    {{ $products->links() }}
@endsection
