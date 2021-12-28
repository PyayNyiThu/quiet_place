@extends('backend.layouts.app')

@section('users.active', 'active')

@section('content')

    <div class="container-fluid">
        <div class="card shadow mb-4" id="Newdiv">
            <div class="card-header">
                <div class="row">
                    <div class="col-8">
                        <h4 class="m-0 font-weight-bold text-info mmfont">Add User</h4>
                    </div>

                    <div class="offset-2 col-2">
                        <a href="{{ route('users.index') }}" class="btn btn-info btn-sm btn-block float-right">
                            <i class="fas fa-backward"></i>
                            Go Back
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form method="post" action="{{ route('users.store') }}" class="m-5"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label mmfont"> Name </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="name" placeholder=""
                                        name="name" value="{{ old('name') }}">
                                    @error('name')
                                        <div class=" alert alert-danger">
                                            <ul>
                                                <li>{{ $message }}</li>
                                            </ul>
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label mmfont"> Email </label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="email" placeholder=""
                                        name="email" value="{{ old('email') }}">
                                    @error('email')
                                        <div class=" alert alert-danger">
                                            <ul>
                                                <li>{{ $message }}</li>
                                            </ul>
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone" class="col-sm-2 col-form-label mmfont"> Phone </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="phone" placeholder=""
                                        name="phone" value="{{ old('phone') }}">
                                    @error('phone')
                                        <div class=" alert alert-danger">
                                            <ul>
                                                <li>{{ $message }}</li>
                                            </ul>
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="address" class="col-sm-2 col-form-label mmfont"> Address </label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="address" rows="3"
                                        name="address">{{ old('address') }}</textarea>
                                    @error('address')
                                        <div class=" alert alert-danger">
                                            <ul>
                                                <li>{{ $message }}</li>
                                            </ul>
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-sm-2 col-form-label mmfont"> Password </label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="password" placeholder=""
                                        name="password" value="{{ old('password') }}">
                                    @error('password')
                                        <div class=" alert alert-danger">
                                            <ul>
                                                <li>{{ $message }}</li>
                                            </ul>
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="offset-2 col-sm-10">

                                    <button type="submit" class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-save"></i> Create
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
