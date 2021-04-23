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
                            <a class="nav-link" href="/admin/products/create">
                                <span data-feather="shopping-cart"></span>
                                Add Product
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/admin/products') }}">
                                <span data-feather="shopping-cart"></span>
                                Show Products
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/admin/users') }}">
                                
                                Users
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/admin/orders') }}">
                               Orders
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            @yield('content')
        </div>
    </div>
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
        feather.replace()
    </script>
    @include('layouts.footer')



</body>

</html>
