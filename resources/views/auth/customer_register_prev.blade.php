@extends('frontend.layouts.app')

@section('content')

    <!-- Rooms Area Start -->
    <div class="bg-img bg-overlay" style="background-image: url({{ asset('frontend/img/bg-img/ba9.jpg') }});"
        data-img-url="{{ asset('frontend/img/bg-img/16.jpg') }}">
        <div class="roberto-rooms-area section-padding-100-0">
            <div class="container">
                <div class="row justify-content-center align-items-center">
                    <div class="col-md-6">
                        <div class="card auth-form mb-5">
                            <div class="card-body">
                                <h3 class="text-center">Customer Register</h3>
                                <p class="text-center text-muted">Fill the form to register</p>
                                <form method="POST" action="{{ route('customer.register-prev') }}">
                                    @csrf

                                    <div class="form-group">
                                        <label for="name">Name</label>

                                        <input id="name" type="text"
                                            class="form-control @error('name') is-invalid @enderror" name="name"
                                            value="{{ old('name') }}">

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email</label>

                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="phone">Phone</label>

                                        <input id="phone" type="number"
                                            class="form-control @error('phone') is-invalid @enderror" name="phone"
                                            value="{{ old('phone') }}">

                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="address">Address</label>

                                        <textarea class="form-control @error('address') is-invalid @enderror" id="address"
                                            rows="3" name="address">{{ old('address') }}</textarea>

                                        @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="password">Password</label>

                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-5">
                                        <label for="password">Confirm Password</label>

                                        <input id="password_confirmation" type="password"
                                            class="form-control @error('password_confirmation') is-invalid @enderror"
                                            name="password_confirmation">

                                        @error('password_confirmation')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    

                                    <button class="btn roberto-btn btn-block mb-5">Register</button>

                                    <div class="d-flex justify-content-between">
                                        <a href="{{ url('customer/login-prev') }}">Already have an account?</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Rooms Area End -->

@endsection
