@extends('backend.layouts.app')

@section('users.active', 'active')

@section('content')

    <div class="container-fluid">
        <div class="card shadow mb-4" id="Newdiv">
            <div class="card-header">
                <div class="row">
                    <div class="col-8">
                        <h4 class="m-0 font-weight-bold text-info mmfont">
                            @if (isset($user))
                                Edit Existing User
                            @else
                                Add User
                            @endif
                        </h4>
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
                        @if (isset($user))
                            <form method="post" action="{{ route('users.update', $user->id) }}" class="m-5"
                                enctype="multipart/form-data">
                                @method('PUT')
                            @else
                                <form method="post" action="{{ route('users.store') }}" class="m-5"
                                    enctype="multipart/form-data">
                        @endif

                        @csrf

                        <?php
                        $name = old('name') != null ? old('name') : (isset($user) ? $user->name : '');
                        $email = old('email') != null ? old('email') : (isset($user) ? $user->email : '');
                        $phone = old('phone') != null ? old('phone') : (isset($user) ? $user->phone : '');
                        $address = old('address') != null ? old('address') : (isset($user) ? $user->address : '');
                        $password = old('password') != null ? old('password') : (isset($user) ? '' : '');
                        ?>

                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label mmfont"> Name </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" placeholder="" name="name"
                                    value="{{ $name }}">
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
                                <input type="email" class="form-control" id="email" placeholder="" name="email"
                                    value="{{ $email }}">
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
                                <input type="text" class="form-control" id="phone" placeholder="" name="phone"
                                    value="{{ $phone }}">
                                @error('phone')
                                    <div class=" alert alert-danger">
                                        <ul>
                                            <li>{{ $message }}</li>
                                        </ul>
                                    </div>
                                @enderror
                            </div>
                        </div>

                        {{-- <div class="form-group row">
                                <label for="roles" class="col-sm-2 col-form-label mmfont"> Role </label>
                                <div class="col-sm-10">
                                    {!! Form::select('roles[]', $roles, $userRole, array('class' => 'form-control','multiple')) !!}
                                    @error('roles')
                                        <div class=" alert alert-danger">
                                            <ul>
                                                <li>{{ $message }}</li>
                                            </ul>
                                        </div>
                                    @enderror
                                </div>
                            </div> --}}

                        <div class="form-group row">
                            <label for="role_id" class="col-sm-2 col-form-label mmfont"> Role </label>
                            <div class="col-sm-10">
                                <select name="roles" class="custom-select" id="role_id">
                                    @foreach ($roles as $row)
                                        @if (isset($user))
                                            <option value="{{ $row }}"
                                                {{ $user_role == $row ? 'selected' : '' }}>
                                                {{ $row }}</option>
                                        @else
                                            <option value="{{ $row }}" {{ old('roles') == $row ? 'selected' : '' }}>{{ $row }}</option>
                                        @endif
                                    @endforeach
                                </select>

                                @error('role_id')
                                    <div class=" alert alert-danger">
                                        <ul>
                                            <li>{{ $message }}</li>
                                        </ul>
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="status" class="col-sm-2 col-form-label mmfont"> Status </label>
                            <div class="col-sm-10">
                                <select name="status" class="custom-select" id="status">
                                    @foreach (config('constants.STATUS') as $key => $value)
                                        @if (isset($user))
                                            <option value="{{ $key }}"
                                                {{ $user->status == $key ? 'selected' : '' }}> {{ $value }}
                                            </option>
                                        @else
                                            <option value="{{ $key }}" {{ old('status') == $key ? "selected" : "" }}>{{ $value }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('status')
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
                                    name="address">{{ $address }}</textarea>

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
                                <input type="password" class="form-control" id="password" placeholder="" name="password"
                                    value="{{ $password }}">

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
                                    <i class="fas fa-save"></i>
                                    @if (isset($user))
                                        Update
                                    @else
                                        Create
                                    @endif
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
