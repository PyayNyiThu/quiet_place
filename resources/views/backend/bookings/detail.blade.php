@extends('backend.layouts.app')

@section('bookings.active', 'active')

@section('content')

    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-8">
                        <h4 class="m-0 font-weight-bold text-info mmfont">{{__('messages.bookings.booking_detail')}}</h4>
                    </div>

                    <div class="offset-2 col-2">
                        <a href="{{ route('bookings.index') }}" class="btn btn-info btn-sm btn-block float-right mmfont">
                            <i class="fas fa-backward"></i>
                            {{__('messages.go_back')}}
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <th>Type</th>
                            <th>Value</th>
                        </thead>
                        <tbody>
                            <tr>
                                <th>{{__('messages.bookings.booking_no')}}</th>
                                <td>{{ $booking->booking_no }}</td>
                            </tr>

                            <tr>
                                <th>{{__('messages.bookings.customer_name')}}</th>
                                <td>{{ $booking->customer->name }}</td>
                            </tr>

                            <tr>
                                <th>{{__('messages.bookings.customer_email')}}</th>
                                <td> {{ $booking->customer->email }} </td>
                            </tr>

                            <tr>
                                <th>{{__('messages.bookings.customer_phone')}}</th>
                                <td> {{ $booking->customer->phone }} </td>

                            </tr>

                            <tr>
                                <th>{{__('messages.township')}}</th>
                                <td> {{ $booking->room->township->name }}</td>
                            </tr>
                            <tr>
                                <th class="align-middle">{{__('messages.bookings.room_photo')}}</th>
                                <td> <img src="{{ asset($booking->room->photo) }}" width="100"
                                    height="100"></td>
                            </tr>
                            <tr>
                                <th>{{__('messages.bookings.room_type')}}</th>
                                <td> {{ $booking->room->roomtype->name }}</td>
                            </tr>
                            <tr>
                                <th>{{__('messages.price')}}</th>
                                <td> {{ $booking->room->price }}</td>
                            </tr>
                            <tr>
                                <th>{{__('messages.capacity')}} </th>
                                <td> {{ $booking->room->capacity }}</td>
                            </tr>
                            <tr>
                                <th>{{__('messages.size')}}</th>
                                <td> {{ $booking->room->size }}</td>
                            </tr>
                            <tr>
                                <th>{{__('messages.bookings.booking_date')}}</th>
                                <td>{{ $booking->booking_date }}</td>
                            </tr>
                            <tr>
                                <th>{{__('messages.bookings.time')}}</th>
                                <td>{{ $booking->time }}</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
