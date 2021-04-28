@extends('admin.layout')

@section('content')
    <main role="main" class="col-md-9 m-2">
      
          <table class="table table-hover table-bordered">
            <thead class="table-dark">
                <tr>
                  <th class='text-center'>  <h6> Product Id </h6></th>
                  <th class='text-center'>  <h6> Thumbnail </h6></th>
                  <th class='text-center'> <h6> Product Name </h6></th>
                  <th class='text-center'> <h6> Price </h6></th>
                  <th class='text-center'> <h6> Quantity </h6></th>
                  <th class='text-center'> <h6> Options </h6></th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($products  as $product)
                  <tr class="align-self-center">
                    <td class='text-center' > {{ $product->id }} </td>
                    <td  class='text-center' > <img src="{{$product->image}}" alt="thumbnail" height="100px" width="100px"> </td>
                    <td  class='text-center' >{{$product->name}}</td>
                    <td class='text-center' > ₹ {{ $product->price}}</td>
                    <td class='text-center' >{{$product->qty}}</td>
                    <td class='text-center' >  
                      <div class="d-flex justify-content-center">
                        <form action="{{'products'}}/{{$product->id}}" method="POST">
                          {{ csrf_field() }}
                          {{ method_field('DELETE') }}
                        <button class="btn btn-sm btn-danger " type="submit">Delete</button>
                      </form>
                      <a href="{{'products'}}/{{$product->id}}" class="btn btn-sm btn-warning" style="margin-left:5px " type="button"> Update </a>
                      </div>
                  </td>
                  
                  </tr>
                  @endforeach()
                
              </tbody>
            </table>
          
    </main>
@endsection

@section('footer')
 {{ $products->links() }}
@endsection