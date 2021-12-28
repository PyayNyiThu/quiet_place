@extends('frontend.layouts.app')

@section('content')

    <!-- Welcome Area Start -->
    <section class="welcome-area">
        <!-- Single Welcome Slide -->
        <!-- Welcome Content -->
        <div class="welcome-content h-100">
            <div class="container h-100">
                <div class="row h-100 align-items-center">
                    <!-- Welcome Text -->
                    <div class="col-12">
                        <div class="hotel-search-form-area pt-3">
                            <div class="container-fluid">
                                <div class="hotel-search-form">
                                    <form action="{{ route('frontend.room_page') }}" method="post">
                                        @csrf
                                        <div class="row justify-content-between align-items-end">
                                            <div class="col-6 col-sm-6 col-md-6 col-lg-3">
                                                <label for="township">Township</label>
                                                <select name="township" id="township" class="form-control">
                                                    <option value="">Select Township</option>
                                                    @foreach ($townships as $row)
                                                        <option value="{{ $row->id }}" <?php if($township == $row->id) {?>selected
                                                            <?php } ?>>{{ $row->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-6 col-sm-6 col-md-6 col-lg-3">
                                                <label for="room">Room Type</label>
                                                <select name="room_type" id="room" class="form-control">
                                                    <option value="">Select Room Type</option>
                                                    @foreach ($room_types as $row)
                                                        <option value="{{ $row->id }}" <?php if($room_type == $row->id) {?>selected
                                                            <?php } ?>>{{ $row->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-12 col-sm-12 col-md-12 col-lg-3">
                                                <label for="booking_date">Booking Date</label>
                                                <input type="date" class="form-control" id="booking_date"
                                                    name="booking_date" value="{{ $booking_date }}" required>
                                            </div>

                                            <!-- <div class="col-6 col-md-2 col-lg-2">
                                                            <label for="time">Time</label>
                                                            <select name="time" id="time" class="form-control">
                                                                <option value="9am-12am">9am-12am</option>
                                                                <option value="12am-3pm">12am-3pm</option>
                                                                <option value="3pm-5pm">3pm-5pm</option>
                                                            </select>
                                                        </div> -->

                                            <div class="col-12 col-sm-12 col-md-12 col-lg-3">
                                                <button type="submit"
                                                    class="form-control btn roberto-btn w-100">Search</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Welcome Area End -->

    <!-- Rooms Area Start -->
    <div class="roberto-rooms-area section-padding-100-0">
        <div class="container">
            <div class="row">
                @foreach ($rooms as $row)
                    <div class="col-12 col-lg-6">
                        <!-- Single Room Area -->
                        <div class="single-room-area d-flex align-items-center mb-50 wow fadeInUp" data-wow-delay="100ms">
                            <!-- Room Thumbnail -->
                            <div class="room-thumbnail">
                                {{-- <a href="{{ route('frontend.room_page_detail', $row->id) }}"> --}}
                                <img src="{{ asset($row->photo) }}" alt=""><!-- </a> -->
                            </div>
                            <!-- Room Content -->
                            <div class="room-content">
                                <h2>{{ $row->roomtype->name }}</h2>
                                <h4>{{ $row->price }} MMK <span>/ Period</span></h4>
                                <div class="room-feature">
                                    <h6>Size: <span>{{ $row->size }} ft</span></h6>
                                    <h6>Capacity: <span>Max person {{ $row->capacity }}</span></h6><br><br>
                                    <h6>Township: <span>{{ $row->township->name }}</span></h6>
                                </div>

                                <form method="get" action="{{ route('frontend.room_page_detail', $row->id) }}">
                                    <input type="hidden" value="{{ $booking_date }}" name="booking_date">
                                    <input type="hidden" value="{{ $row->id }}" name="id">
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
                    <!-- <button type="submit" class="btn" style="background: #1cc3b2;color: white;">Book</button> -->
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
                    <h3 class="text-center text-danger"> {{@session('error')}} </h3>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-dismiss="modal"
                        style="background: #1cc3b2;color: white;">Ok</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on('click', '.view-detail-btn', function(e) {
                e.preventDefault();

                var booking_date = $('#booking_date').val();
                var form = $(this).closest("form");

                if (booking_date == "") {
                    $('#selectBookingDateModal').modal('show');
                } else {
                    form.submit();
                }
            });

            @if (session('error'))
                $('#bookingErrorModal').modal('show');
            @endif
        });
    </script>
@endsection
