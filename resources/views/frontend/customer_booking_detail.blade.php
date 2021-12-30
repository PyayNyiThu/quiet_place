@extends('frontend.layouts.app')

@section('content')

    {{-- <form method="post" action="{{ route('book.store') }}" class="m-5" enctype="multipart/form-data"> --}}
    @csrf
    <section class="ftco-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-md-12 ftco-animate">
                            <div class="about-right">
                                <img src="{{ asset($booking->room->photo) }}" class="img-fluid" alt="" />
                                <h2 class="d-inline">{{ $booking->room->roomtype->name }}</h2>
                            </div>
                            {{-- <a href="#" class="btn roberto-btn float-lg-right mt-1 mb-50" data-toggle="modal" data-target="#exampleModalLong">Book</a> --}}
                            <hr>

                        </div>

                        <div class="col-md-12 room-single mt-2 mb-5 ftco-animate">
                            <h4>Accommodates</h4>
                            <div class="d-md-flex mt-4 mb-5">
                                <div class="row">
                                    <div class="col-lg-6 p-3">
                                        <span class="fa fa-users" aria-hidden="true"></span>&nbsp&nbsp<span>Maximum
                                            total:</span> {{ $booking->room->capacity }} Persons
                                    </div>

                                    <div class="col-lg-6 p-3">
                                        <span class="fa fa-building" aria-hidden="true"></span>&nbsp&nbsp<span>Size:</span>
                                        {{ $booking->room->size }}
                                        ft
                                    </div>

                                    @foreach ($booking->room->services as $room_s)
                                        <div class="col-lg-6 p-3">
                                            <img src="{{ asset($room_s->photo) }}" alt="" width="22  " height="22">
                                            {{ $room_s->name }}
                                        </div>
                                    @endforeach

                                </div>
                            </div>

                            <hr>

                            <h4>About this place</h4>
                            <p>{{ $booking->room->description }}</p>
                        </div>
                    </div>
                </div><!-- .col-md-8 -->

                <div class="col-12 col-lg-4 order-2">
                    <div class="hotel-reservation--area mb-100">

                        <div class="sidebar-wrap bg-light ftco-animate">
                            <div class="panel panel-default">
                                <div class="panel-heading text-center">
                                    <h3>Booking Information</h3>
                                </div>

                                <div class="panel-body">
                                    <table class="table table-striped table-sm">
                                        <tbody>
                                            <tr class="d-flex">
                                                <td class="col-4 text-myp">
                                                    Agent Name
                                                </td>
                                                <td class="col-8 text-myp">
                                                    Quiet Place
                                                </td>
                                            </tr>

                                            <tr class="d-flex">
                                                <td class="col-4 text-my">
                                                    Room Type
                                                </td>
                                                <td class="col-8 text-my">
                                                    {{ $booking->room->roomtype->name }}
                                                </td>
                                            </tr>

                                            <tr class="d-flex">
                                                <td class="col-4 text-my">
                                                    Township
                                                </td>
                                                <td class="col-8">
                                                    {{ $booking->room->township->name }}
                                                </td>
                                            </tr>

                                            <tr class="d-flex">
                                                <td class="col-4 text-my">
                                                    Date
                                                </td>
                                                <td class="col-8">
                                                    {{ $booking->booking_date }}
                                                </td>
                                            </tr>

                                            <tr class="d-flex">
                                                <td class="col-4 text-my">
                                                    Time
                                                </td>
                                                <td class="col-8">
                                                    {{-- @foreach($booking_time as $row)
                                                    {{$row->time}},
                                                    @endforeach --}}
                                                    {{$booking->time}}
                                                </td>
                                            </tr>

                                            <tr class="d-flex">
                                                <td class="col-4 text-my">
                                                    Total Cost
                                                </td>
                                                <td class="col-8">
                                                    {{ $booking->room->price }} MMK
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <hr />
                                    <a href="{{route('frontend.customer_booking_list', Auth::guard('customer')->user()->id)}}">
                                        <button type="button" class="btn roberto-btn btn-block checkout">Back</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
 <!-- .section -->

@endsection
