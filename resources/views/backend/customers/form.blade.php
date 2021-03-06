@extends('backend.layouts.app')

@section('customers.active', 'active')

@section('content')

    <div class="container-fluid">
        <div class="card shadow mb-4" id="Newdiv">
            <div class="card-header">
                <div class="row">
                    <div class="col-8">
                        <h4 class="m-0 font-weight-bold text-info mmfont">
                            @if (isset($customer))
                            {{__('messages.customers.edit_customer')}}
                            @else
                            {{__('messages.customers.create_customer')}}
                            @endif
                        </h4>
                    </div>

                    <div class="offset-2 col-2">
                        <a href="{{ route('customers.index') }}" class="btn btn-info btn-sm btn-block float-right">
                            <i class="fas fa-backward"></i>
                            {{__('messages.go_back')}}
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        @if (isset($customer))
                            <form method="post" action="{{ route('customers.update', $customer->id) }}"
                                class="m-5" enctype="multipart/form-data">
                                @method('PUT')
                            @else
                                <form method="post" action="{{ route('customers.store') }}" class="m-5"
                                    enctype="multipart/form-data">
                        @endif

                        @csrf

                        <?php
                        $name = old('name') != null ? old('name') : (isset($customer) ? $customer->name : '');
                        $email = old('email') != null ? old('email') : (isset($customer) ? $customer->email : '');
                        $phone = old('phone') != null ? old('phone') : (isset($customer) ? $customer->phone : '');
                        $address = old('address') != null ? old('address') : (isset($customer) ? $customer->address : '');
                        $password = old('password') != null ? old('password') : (isset($customer) ? '' : '');
                        ?>

                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label mmfont"> {{__('messages.name')}} </label>
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
                            <label for="email" class="col-sm-2 col-form-label mmfont"> {{__('messages.email')}} </label>
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
                            <label for="phone" class="col-sm-2 col-form-label mmfont"> {{__('messages.phone')}} </label>
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

                        <div class="form-group row">
                            <label for="status" class="col-sm-2 col-form-label mmfont"> {{__('messages.status')}} </label>
                            <div class="col-sm-10">
                                <select name="status" class="custom-select" id="status">
                                    @foreach (config('constants.STATUS') as $key => $value)
                                        @if (isset($customer))
                                            <option value="{{ $key }}"
                                                {{ $customer->status == $key ? 'selected' : '' }}> {{ $value }}
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
                            <label for="address" class="col-sm-2 col-form-label mmfont"> {{__('messages.address')}} </label>
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
                            <label for="password" class="col-sm-2 col-form-label mmfont"> {{__('messages.password')}} </label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="password" placeholder="" name="password" value="{{ $password }}">

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
                                    @if (isset($customer))
                                    {{__('messages.update')}}
                                    @else
                                    {{__('messages.create')}}
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
