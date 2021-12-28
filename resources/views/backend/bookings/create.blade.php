@extends('backend.layouts.app')

@section('bookings.active', 'active')

@section('content')

    <div class="container-fluid">
        <div class="card shadow mb-4" id="Newdiv">
            <div class="card-header">
                <div class="row">
                    <div class="col-8">
                        <h4 class="m-0 font-weight-bold text-info mmfont">Add Booking</h4>
                    </div>

                    <div class="offset-2 col-2">
                        <a href="{{ route('bookings.index') }}" class="btn btn-info btn-sm btn-block float-right">
                            <i class="fas fa-backward"></i>
                            Go Back
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form method="post" action="{{ route('bookings.store') }}" class="m-5"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="booking_no" class="col-sm-2 col-form-label mmfont"> Booking No </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="booking_no" placeholder=""
                                         value="Booking No. is auto generate" disabled>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="customer_id" class="col-sm-2 col-form-label mmfont">Customer</label>
                                <div class="col-sm-10">
                                    <select name="customer_id" class="custom-select" id="customer_id">
                                        @foreach ($customer as $row)
                                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('customer_id')
                                        <div class=" alert alert-danger">
                                            <ul>
                                                <li>{{ $message }}</li>
                                            </ul>
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="room_id" class="col-sm-2 col-form-label mmfont">Room</label>
                                <div class="col-sm-10">
                                    <select name="room_id" class="custom-select" id="room_id">
                                        @foreach ($room as $row)
                                            <option value="{{ $row->id }}">{{ $row->id }}</option>
                                        @endforeach
                                    </select>
                                    @error('room_id')
                                        <div class=" alert alert-danger">
                                            <ul>
                                                <li>{{ $message }}</li>
                                            </ul>
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="booking_date" class="col-sm-2 col-form-label mmfont">Booking Date</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" id="booking_date" placeholder=""
                                        name="booking_date" value="{{old('booking_date')}}">
                                    @error('booking_date')
                                        <div class=" alert alert-danger">
                                            <ul>
                                                <li>{{ $message }}</li>
                                            </ul>
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-2">Time</div>
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        @foreach (config('constants.TIME') as $key => $value)
                                            <input class="form-check-input" type="radio"
                                                id="{{$key}}" value="{{$key}}"
                                                name="booking_time">
                                            <label for="{{$key}}"
                                                class="mr-4 form-check-label">{{$value}}</label>
                                        @endforeach
                                    </div>
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
