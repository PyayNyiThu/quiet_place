@extends('frontend.layouts.app')

@section('content')



    <section class="welcome-area">
        <!-- Single Welcome Slide -->
        <div class="single-welcome-slide bg-img bg-overlay"
            style="background-image: url({{ asset('frontend/img/bg-img/ba9.jpg') }});"
            data-img-url="{{ asset('frontend/img/bg-img/16.jpg') }}">
            <!-- Welcome Content -->
            <div class="welcome-content h-100">
                <div class="container h-100">
                    <div class="row h-100 align-items-center">
                        <!-- Welcome Text -->
                        <div class="col-12">
                            <div class="container">
                                <div class="row justify-content-center align-items-center" style="height: 100vh">
                                    <div class="col-md-6">
                                        <div class="card auth-form">
                                            <div class="card-body">
                                                <h3 class="text-center">Admin Login</h3>
                                                <p class="text-center text-muted">Fill the form to login</p>
                                                <form method="POST" action="{{ route('login') }}">
                                                    @csrf
                        
                                                    {{-- <div class="form-group">
                                                        <label for="phone">Phone</label>
                        
                                                        <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror"
                                                            name="phone" value="{{ old('phone') }}">
                        
                                                        @error('phone')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div> --}}

                                                    <div class="form-group">
                                                        <label for="email">Email</label>
                        
                                                        <input id="email" type="text" class="form-control @error('email') is-invalid @enderror"
                                                            name="email" value="{{ old('email') }}">
                        
                                                        @error('email')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                        
                                                    <div class="form-group mb-5">
                                                        <label for="password">Password</label>
                        
                                                        <input id="password" type="password"
                                                            class="form-control @error('password') is-invalid @enderror" name="password">
                        
                                                        @error('password')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                        
                                                    <button class="btn roberto-btn btn-block mb-5">Login</button>
                        
                                                    <p class="text-center">Test account for admin dashboard</p>

                                                    <div class="d-flex justify-content-between">
                                                        {{-- <a href="{{ route('register') }}">Create new account</a> --}}
                        
                                                        {{-- @if (Route::has('password.request'))
                                                            <a href="{{ route('password.request') }}">
                                                                {{ __('Forgot Your Password?') }}
                                                            </a>
                                                        @endif --}}
                                                        
                                                        <code>
                                                            Email - alice@gmail.com <br>
                                                            Password - password <br>
                                                            Role - Admin
                                                        </code>
                                                        
                                                        <code>
                                                            Email - bob@gmail.com <br>
                                                            Password - password <br>
                                                            Role - User
                                                        </code>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Welcome Area End -->
@endsection
