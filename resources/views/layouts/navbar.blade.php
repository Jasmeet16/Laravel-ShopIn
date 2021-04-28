<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous" />

    <link href="/css/album.css" rel="stylesheet">
    <link href="/css/dashboard.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>
        .buttons {
            display: flex;
            justify-content: space-around;
            background: transparent;
        }

        .navbar-dark .navbar-brand {
            background: transparent;
        }

        .navbar a {
            color: whitesmoke;
            margin-left: 10px;
        }

        .navbar a:hover {
            color: whitesmoke;
        }

        main {
            min-height: 75vh;
        }

    </style>
</head>
<header>
    <div class="navbar navbar-dark bg-dark box-shadow">
        <div class="container d-flex justify-content-between">
            <a href="/" class="navbar-brand d-flex align-items-center">
                <strong>
                    <h3>ShopIn</h3>
                </strong>
            </a>
            @if (Auth::guest())
                <div class="buttons">
                    <a href="/login" class="navbar-brand d-flex align-items-center">
                        <strong>Login</strong>
                    </a>
                    <a href="/register" class="navbar-brand d-flex align-items-center">
                        <strong>Register</strong>
                    </a>
                </div>
            @else
                <ul class="buttons" style="list-style-type:none;">
                    <li>
                        @if (Auth::user()->admin)
                            <a href="{{ url('/admin') }}" role="button" aria-expanded="false">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ url('/') }}" role="button" aria-expanded="false">
                                {{ Auth::user()->email }}
                            </a>
                            <strong>
                                <a href="{{ url('/cart') }}" role="button" aria-expanded="false">
                                    Cart
                                </a>
                            </strong>
                        @endif
                    </li>
                    <li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                        <strong>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                        </strong>
                    </li>
                </ul>
            @endif
            <script src="{{ asset('js/app.js') }}"></script>
        </div>
    </div>
</header>
