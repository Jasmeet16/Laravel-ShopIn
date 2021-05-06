@extends('admin.layout')

@section('content')
    <main role="main" class="col-md-9">
        @include('error')
        <div class="container">
            @if (\Session::has('message'))
                <div class="alert alert-success mt-5">{!! \Session::get('message') !!}</div>
            @endif
            <h4 class='m-4 text-center'> Add a new Product</h4>
            <form class="mt-3" method="POST" action='/admin/products' enctype='multipart/form-data'>
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name='name' id="name" value="{{old('name')}}">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" name='description' id="description" >{{old('description')}}</textarea>
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" class="form-control" name='price' id="price" value="{{old('price')}}">
                </div>
                <div class="form-group">
                    <label for="quantity">Quantity</label>
                    <input type="number" class="form-control" name='quantity' id="quantity" value="{{old('quantity')}}">
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="form-control" name='image' id="image" value="{{old('image')}}">
                </div>

                <button class="btn btn-dark py-2 mt-3 px-5" type="submit"> Submit </button>
            </form>
        </div>
    </main>
@endsection
