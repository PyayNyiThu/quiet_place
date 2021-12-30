@extends('frontend.layouts.app')

@section('content')

    <!-- Rooms Area Start -->
    <div class="roberto-rooms-area">
        <div class="container">
            @if ($booking_list->count())
                <h2 class="text-center mb-5 mt-3 booking-section">Your Booking List</h2>
                <div class="row">
                    @foreach ($booking_list as $row)
                        <div class="col-12 col-lg-6">
                            <!-- Single Room Area -->
                            <div class="single-room-area d-flex align-items-center mb-50 wow fadeInUp"
                                data-wow-delay="100ms">
                                <!-- Room Thumbnail -->
                                <div class="room-thumbnail">
                                    {{-- <a href="{{ route('frontend.room_page_detail', $row->id) }}"> --}}
                                    <img src="{{ asset($row->room->photo) }}" alt=""><!-- </a> -->
                                </div>
                                <!-- Room Content -->
                                <div class="room-content">
                                    <h2>{{ $row->room->roomtype->name }}</h2>
                                    <h4>{{ $row->room->price }} MMK <span>/ Period</span></h4>
                                    {{-- <div class="room-feature"> --}}
                                    <h6>Size: <span>{{ $row->room->size }} ft</span></h6>
                                    <h6>Capacity: <span>Max person {{ $row->room->capacity }}</span></h6>
                                    <h6>Township: <span>{{ $row->room->township->name }}</span></h6>
                                    <h6>Date: <span>{{ $row->booking_date }}</span></h6>
                                    <h6>Time: <span>{{ $row->time }}</span></h6>
                                    {{-- </div> --}}

                                    <form method="get"
                                        action="{{ route('frontend.customer_booking_detail', [$row->customer_id, $row->id]) }}">
                                        <button type="submit" class="btn view-detail-btn">View Details <i
                                                class="fa fa-long-arrow-right" aria-hidden="true"></i></button>
                                    </form>
                                </div>
                            </div>
                            <!-- Single Room Area -->
                            <!-- Pagination -->
                        </div>
                    @endforeach
                </div>
            @else
                <h2 class="text-center mb-5 mt-3 booking-section text-danger">You have no booking!</h2>
            @endif
        </div>
    </div>
    <!-- Rooms Area End -->

    <!-- Call To Action Area Start -->
    <section class="roberto-cta-area">
        <div class="container">
            <div class="cta-content bg-img bg-overlay jarallax"
                style="background-image: url({{ asset('frontend/img/bg-img/c5.jpg') }});">
                <div class="row align-items-center">
                    <div class="col-12 col-md-7">
                        <div class="cta-text mb-50">
                            <h2>Contact us now!</h2>
                            <h6>Contact (+95) 9421099378 to book directly</h6>
                        </div>
                    </div>
                    <div class="col-12 col-md-5 text-right">
                        <a href="#" class="btn roberto-btn mb-50">Contact Now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Call To Action Area End -->


    <div class="modal fade" id="selectBookingDateModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background: #1cc3b2;color: white;">
                    Warning!
                </div>

                <div class="modal-body">
                    <h3 class="text-center text-danger">Please Search, select booking date!. Thank You.</h3>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger roberto-btn" data-dismiss="modal" name="ok">Ok</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="bookingErrorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header roberto-btn">
                    Error Box
                </div>

                <div class="modal-body">
                    <h3 class="text-center text-danger"> {{ @session('error') }} </h3>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-dismiss="modal"
                        style="background: #1cc3b2;color: white;">Ok</button>
                </div>
            </div>
        </div>
    </div>

@endsection
