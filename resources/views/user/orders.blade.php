@extends( 'layouts.layout' )
@inject('cart', 'App\Http\Controllers\CartController')
@section('content')

    <div class="album py-5 bg-light">
        <div class="container">
            <h2 class='mb-5'>My Orders</h2>
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                  <thead>
                    <tr>
                      <th>Image</th>
                      <th>Product Name</th>
                      <th>Price</th>
                      <th>Quantity</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($orders  as $order)
                      <tr class="align-self-center">
                        <td> <img src="{{$cart->getProduct($order->product_id)[0]->image}}" alt="thumbnail" height="150px" width="150px"> </td>
                        <td >{{$cart->getProduct($order->product_id)[0]->name}}</td>
                        <td>{{ $cart->getProduct($order->product_id)[0]->price}}</td>
                        <td>{{$order->qty}}</td>
                      </tr>
                      @endforeach()  
                  </tbody>
                </table>
              </div>
        </div>
    </div>
@endsection
