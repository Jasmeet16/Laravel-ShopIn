@extends('admin.layout')

@section('content')
    <main role="main" class="col-md-9 pt-3 px-4">
        <div class="alert alert-info text-center">
            <h3>Welcome {{ Auth::user()->email }} you are logged in as Admin</h3>
        </div>
    </main>

@endsection
