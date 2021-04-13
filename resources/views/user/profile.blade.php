@extends('layouts.layout')

@section('content')
    <div class="album py-5 bg-light">
        <div class="container">
          <h1 class="mb-3">User Profile</h1>
            <form action="{{ url('/profile') }}" method="POST">
              {{ csrf_field() }}
                <div class="form-row">
                    <div class="form-row d-flex">
                        <div class="col-md-4 mb-3">
                            <label for="validationServer01"> Name</label>
                            <input type="text" class="form-control" id="validationServer01" name="name" placeholder="Name"
                                required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="col-md-1 ">
                        </div>
                        <div class="col-md-4 ">
                            <label for="validationServer01">Phone</label>
                            <input type="text" class="form-control" id="validationServer01" name='phone' placeholder="Phone"
                                required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                    </div>
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="validationServer03">Address Line 1</label>
                            <input type="text" class="form-control" id="validationServer03" name="address" placeholder="City" required>
                            <div class="invalid-feedback">
                                Please provide a valid address.
                            </div>
                        </div>
                        <div class="form-row d-flex">
                            <div class="col-md-3 mb-3">
                                <label for="validationServer04">State</label>
                                <input type="text" class="form-control" id="validationServer04" name="state" placeholder="State"
                                    required>
                                <div class="invalid-feedback">
                                    Please provide a valid state.
                                </div>
                            </div>
                            <div class="col-md-1 ">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="validationServer05">Zip Code</label>
                                <input type="text" class="form-control" id="validationServer05" name='zip' placeholder="Zip" required>
                                <div class="invalid-feedback">
                                    Please provide a valid zip.
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <button class="btn btn-primary" type="submit">Submit form</button>
            </form>
        </div>
    </div>
@endsection
