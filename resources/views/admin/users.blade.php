@extends('admin.layout')

@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        <div class="container">
            <ul class="list-group flush">
                @foreach ($users as $user)
                    <li class="list-group-item">
                        <a href="users/{{ $user->id }}">
                            <p>
                                <span>{{ $user->id }}</span>
                                <span>{{ $user->email }}</span>
                            </p>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </main>
@endsection
