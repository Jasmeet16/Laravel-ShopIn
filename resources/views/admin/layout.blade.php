<!doctype html>
<html lang="en">


<body>
    @include('layouts.navbar')

    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                       
                        <li class="nav-item">
                            <a class="nav-link {{ Request::path() == 'admin/products/create' ? 'active' : '' }}"  href="/admin/products/create">
                                
                                Add Product
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::path() == 'admin/products' ? 'active' : '' }}" href="{{ url('/admin/products') }}">
                                
                                Show Products
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::path() == 'admin/users' ? 'active' : '' }}" href="{{ url('/admin/users') }}">
                                
                                Users
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::path() == 'admin/orders' ? 'active' : '' }}" href="{{ url('/admin/orders') }}">
                               Orders
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            @yield('content')
        </div>
    </div>
   
    @include('layouts.footer')



</body>

</html>
