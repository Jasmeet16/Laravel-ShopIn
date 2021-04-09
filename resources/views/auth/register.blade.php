@extends('layouts.layout')

@section('content')
    <div class="album py-5 bg-light min-vh-80">
        <div class="container h-100">
            <div class="row h-100 justify-content-center align-items-center">
                <div class="col-6">
                    <h3>Register</h3>
                    <form class="form w-100" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}


                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email">E-Mail Address</label>


                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"
                                required>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif

                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password">Password</label>


                            <input id="password" type="password" class="form-control" name="password" required>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif

                        </div>

                        <div class="form-group">
                            <label for="password-confirm">Confirm Password</label>


                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                                required>

                        </div>

                        <button type="submit" class="form-control btn-primary mt-3">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
