@extends('admin.layout')

@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        <div class="container">
            <h3>List of Users</h3>
            <ul class="list-group">
                <li class="list-group-item align-items-center">

                    <p class="d-flex justify-content-between">
                        <span>User's Id</span>
                        <span> Email </span>
                        <span>
                            Actions
                        </span>
                    </p>

                </li>
                @foreach ($users as $user)
                    <li class="list-group-item r">

                        <div class="d-flex justify-content-between">
                            <div class="text-center"> <span  >{{ $user->id }}</span></div>

                            <div class="text-center"> <span>{{ $user->email }}</span></div>

                            <div class="text-center"> <a type="button" class="btn btn-info" href="users/{{ $user->id }}">
                                Details
                            </a></div>

                           
                            
                           
                        </div>

                    </li>
                @endforeach
            </ul>
        </div>
    </main>
@endsection
