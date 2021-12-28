@extends('backend.layouts.app')

@section('rooms.active', 'active')

@section('content')

    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-8">
                        <h4 class="m-0 font-weight-bold text-info mmfont">Booking Detail</h4>
                    </div>

                    <div class="offset-2 col-2">
                        <a href="{{ route('bookings.index') }}" class="btn btn-info btn-sm btn-block float-right mmfont">
                            <i class="fas fa-backward"></i>
                            Go Back
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
                                <th>Booking No.</th>
                                <td>{{ $booking->booking_no }}</td>
                            </tr>

                            <tr>
                                <th>Customer Name</th>
                                <td>{{ $booking->customer->name }}</td>
                            </tr>

                            <tr>
                                <th>Customer Email</th>
                                <td> {{ $booking->customer->email }} </td>
                            </tr>

                            <tr>
                                <th>Customer Phone</th>
                                <td> {{ $booking->customer->phone }} </td>

                            </tr>

                            <tr>
                                <th>Township</th>
                                <td> {{ $booking->room->township->name }}</td>
                            </tr>
                            <tr>
                                <th class="align-middle">Room Photo </th>
                                <td> <img src="{{ asset($booking->room->photo) }}" width="100"
                                    height="100"></td>
                            </tr>
                            <tr>
                                <th>Room Type</th>
                                <td> {{ $booking->room->roomtype->name }}</td>
                            </tr>
                            <tr>
                                <th>Price</th>
                                <td> {{ $booking->room->price }}</td>
                            </tr>
                            <tr>
                                <th>Capacity </th>
                                <td> {{ $booking->room->capacity }}</td>
                            </tr>
                            <tr>
                                <th>Size</th>
                                <td> {{ $booking->room->size }}</td>
                            </tr>
                            <tr>
                                <th>Booking Date</th>
                                <td>{{ $booking->booking_date }}</td>
                            </tr>
                            <tr>
                                <th>Time</th>
                                <td>{{ $booking->time }}</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
