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
                                <h3 class="text-center">Customer Profile</h3>
                                <p class="text-center text-muted">Fill the form to data if you want to change</p>
                                <form method="POST" action="{{ route('frontend.profile-update', Auth::guard('customer')->user()->id) }}">
                                    @csrf

                                    <div class="form-group">
                                        <label for="name">Name</label>

                                        <input id="name" type="text"
                                            class="form-control @error('name') is-invalid @enderror" name="name"
                                            value="{{ $customer->name }}">

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
                                            value="{{ $customer->email }}">

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
                                            value="{{ $customer->phone }}">

                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="address">Address</label>

                                        <textarea class="form-control @error('address') is-invalid @enderror" id="address"
                                            rows="3" name="address">{{ $customer->address }}</textarea>

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

                                    <code>You don't type password field, password will save your old password. If you type password field, password will save a new password.</code>

                                    {{-- <div class="form-group mb-5">
                                        <label for="password">Confirm Password</label>

                                        <input id="password_confirmation" type="password"
                                            class="form-control @error('password_confirmation') is-invalid @enderror"
                                            name="password_confirmation">

                                        @error('password_confirmation')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div> --}}

                                    

                                    <button class="btn roberto-btn btn-block mb-5">Update</button>

                                    {{-- <div class="d-flex justify-content-between">
                                        <a href="{{ route('customer.login') }}">Already have an account?</a>
                                    </div> --}}
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
