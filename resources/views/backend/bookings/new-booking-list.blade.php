@extends('backend.layouts.app')

@section('bookings.active', 'active')

@section('content')

    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-8">
                        <h4 class="m-0 font-weight-bold text-info mmfont">{{__('messages.bookings.new_bookings_list')}}</h4>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr align="center">
                                <th>{{__('messages.no')}}</th>
                                <th>{{__('messages.bookings.booking_no')}}</th>
                                <th>{{__('messages.bookings.customer_data')}}</th>
                                <th>{{__('messages.bookings.room_data')}}</th>
                                <th>{{__('messages.bookings.booking_date')}}</th>
                                <th>{{__('messages.bookings.time')}}</th>
                                <th>{{__('messages.status')}}</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($bookings as $row)
                                <tr align="center">
                                    <td class="align-middle">{{ $i++ }}</td>
                                    <td class="align-middle">{{ $row->booking_no }}</td>
                                    <td class="align-middle">
                                        <a href="{{ route('customers.show', $row->customer->id) }}" class="btn">
                                            <table class="table table-bordered">
                                                <tr>
                                                    <th>Name</th>
                                                    <td> {{ $row->customer->name }} </td>
                                                </tr>

                                                <tr>
                                                    <th>Email</th>
                                                    <td> {{ $row->customer->email }} </td>
                                                </tr>

                                                <tr>
                                                    <th>Phone</th>
                                                    <td> {{ $row->customer->phone }} </td>
                                                </tr>
                                            </table>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('rooms.show', $row->room->id) }}" class="btn">
                                            <table class="table table-bordered">
                                                <tr align="center">
                                                    <td colspan="2">
                                                        <img src="{{ asset($row->room->photo) }}" width="100"
                                                            height="100">
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <th>Township</th>
                                                    <td> {{ $row->room->township->name }} </td>
                                                </tr>

                                                <tr>
                                                    <th>Room Type</th>
                                                    <td> {{ $row->room->roomtype->name }} </td>
                                                </tr>

                                                <tr>
                                                    <th>Price</th>
                                                    <td> {{ $row->room->price }} MMK</td>
                                                </tr>

                                                <tr>
                                                    <th>Size</th>
                                                    <td> {{ $row->room->size }} </td>
                                                </tr>

                                                <tr>
                                                    <th>Capacity</th>
                                                    <td> {{ $row->room->capacity }} </td>
                                                </tr>
                                            </table>
                                        </a>
                                    </td>
                                    <td class="align-middle">{{ $row->booking_date }}</td>
                                    <td class="align-middle">{{ $row->time }}</td>

                                    @if($row->status == 1)
                                        <td class="align-middle text-primary"><a href="{{url('admin/change-status/' . $row->id)}}">New Booking</a></td>
                                    @else
                                    <td class="align-middle text-success">Read Booking</td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


@endsection

