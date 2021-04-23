@extends('admin.layout')

@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
      @include('error')
      <form method="POST" action='/admin/products' enctype='multipart/form-data'>
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <input type="number" value="{{$product->id}}" name="id" hidden>
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" class="form-control" value="{{$product->name}}" name='name' id="name" >
        </div>
        <div class="form-group">
          <label for="description">Description</label>
          <textarea  class="form-control"  name='description' id="description" style="height:250px"> {{$product->description}} </textarea>
        </div>
        <div class="form-group">
          <label for="price">Price</label>
          <input type="number" class="form-control" value="{{$product->price}}" name='price' id="price" >
        </div>
        <div class="form-group">
          <label for="quantity">Quantity</label>
          <input type="number" class="form-control" value="{{$product->qty}}" name='quantity' id="quantity" >
        </div>
        <div class="form-group">
          <label for="image">Image</label>
          <input type="file" class="form-control" value="{{$product->image}}" name='image' id="image" >
        </div>
      
        <button class="form-control mt-3" type="submit"> Submit </button>
      </form>

    </main>
@endsection
  