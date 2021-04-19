@extends('layouts.layout')

@section('content')
    <div class="album py-5 bg-light min-vh-80">
        <div class="container h-100">
            <div class="row h-100 justify-content-center align-items-center">
                <div class="col-6">
                    <h3 class="text-center">Login</h3>
                    <form class="mb-3 form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"
                                required autofocus>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong style="color: red">{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="mb-3 form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>


                            <input id="password" type="password" class="form-control" name="password" required>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong style="color: red">{{ $errors->first('password') }}</strong>
                                </span>
                            @endif

                        </div>
                        <button type="submit" class="form-control btn-primary mt-3">
                            Login
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
