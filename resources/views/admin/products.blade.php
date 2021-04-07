@extends('admin.layout')

@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        <h1>Products</h1>
        <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>Thumbnail</th>
                  <th>Product Name</th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th>Options</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($products  as $product)
                  <tr class="align-self-center">
                    <td> <img src="{{$product->image}}" alt="thumbnail" height="150px" width="150px"> </td>
                    <td >{{$product->name}}</td>
                    <td>{{ $product->price}}</td>
                    <td>{{$product->qty}}</td>
                    <td>sit</td>
                  </tr>
                  @endforeach()
                
              </tbody>
            </table>
          </div>
    </main>
@endsection
