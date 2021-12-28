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
                                <img src="{{ asset($room->photo) }}" class="img-fluid" alt="" />
                                <h2 class="d-inline">{{ $room->roomtype->name }}</h2>
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
                                            total:</span> {{ $room->capacity }} Persons
                                    </div>

                                    <div class="col-lg-6 p-3">
                                        <span class="fa fa-building" aria-hidden="true"></span>&nbsp&nbsp<span>Size:</span>
                                        {{ $room->size }}
                                        ft
                                    </div>

                                    @foreach ($room->services as $room_s)
                                        <div class="col-lg-6 p-3">
                                            <img src="{{ asset($room_s->photo) }}" alt="" width="22  " height="22">
                                            {{ $room_s->name }}
                                        </div>
                                    @endforeach

                                </div>
                            </div>

                            <hr>

                            <h4>About this place</h4>
                            <p>{{ $room->description }}</p>
                        </div>
                    </div>
                </div><!-- .col-md-8 -->

                <div class="col-12 col-lg-4 order-2">
                    <div class="hotel-reservation--area mb-100">
                        <div class="sidebar-wrap bg-light ftco-animate">

                            <h3 class="heading mb-4">Time</h3>

                            @foreach (config('constants.TIME') as $key => $value)
                                <div class="form-check">
                                    <input type="radio" class="form-check-input radio-btn" id="{{$key}}" name="btime"
                                        value="{{ $key }}">
                                    <label class="form-check-label" for="{{$key}}">
                                        <p class="rate"><span>{{ $value }}</span></p>
                                    </label>
                                </div>
                            @endforeach

                            {{-- <div class="form-check">
                                <input type="radio" class="form-check-input radio-btn" id="time2" name="btime"
                                    value="1 pm - 4 pm">
                                <label class="form-check-label" for="time2">
                                    <p class="rate"><span>1 pm - 4 pm</span></p>
                                </label>
                            </div>

                            <div class="form-check">
                                <input type="radio" class="form-check-input radio-btn" id="time3" name="btime"
                                    value="5 pm - 8 pm">
                                <label class="form-check-label" for="time3">
                                    <p class="rate"><span>5 pm - 8 pm</span></p>
                                </label>
                            </div> --}}
                        </div>

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
                                                    {{ $room->roomtype->name }}
                                                </td>
                                            </tr>

                                            <tr class="d-flex">
                                                <td class="col-4 text-my">
                                                    Township
                                                </td>
                                                <td class="col-8">
                                                    {{ $room->township->name }}
                                                </td>
                                            </tr>

                                            <tr class="d-flex">
                                                <td class="col-4 text-my">
                                                    Date
                                                </td>
                                                <td class="col-8">
                                                    {{ $booking_date }}
                                                </td>
                                            </tr>

                                            <tr class="d-flex">
                                                <td class="col-4 text-my">
                                                    Time
                                                </td>
                                                <td class="col-8">
                                                    <span class="booking_time"></span>
                                                </td>
                                            </tr>

                                            <tr class="d-flex">
                                                <td class="col-4 text-my">
                                                    Total Cost
                                                </td>
                                                <td class="col-8">
                                                    {{ $room->price }} MMK
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <hr />

                                    <button type="button" class="btn roberto-btn btn-block checkout">Checkout</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </form> <!-- .section -->


    <div class="modal fade" id="selectTimeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background: #1cc3b2;color: white;">
                    Warning!
                </div>

                <div class="modal-body">
                    <h3 class="text-center text-danger">Please Select Time!. Thank You.</h3>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn roberto-btn" data-dismiss="modal" name="ok">Ok</button>
                    {{-- <button type="submit" class="btn" style="background: #1cc3b2;color: white;" data-dismiss="modal">Ok</button> --}}
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="bookingFormModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <img src="{{ asset($room->photo) }}" class="img-fluid" alt="" width="500">
                <div class="modal-body">
                    <h2 class="text-center">Booking Form</h2>
                    {{-- <form> --}}
                    <div class="form-group">
                        <label for="room">Room Type</label>
                        <input type="text" class="form-control" value="{{ $room->roomtype->name }}"
                            readonly="readonly">
                    </div>

                    <div class="form-group">
                        <label for="room">Township</label>
                        <input type="text" class="form-control" value="{{ $room->township->name }}"
                            readonly="readonly">
                    </div>

                    <div class="form-group">
                        <label for="date">Booking Date</label>
                        <input type="date" class="form-control" value="{{ $booking_date }}" readonly="readonly">
                    </div>

                    <div class="form-group">
                        <label for="booking_time">Booking Time</label>
                        <input type="text" class="form-control booking_time" id="booking_time" readonly="readonly">
                    </div>

                    @auth('customer')
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name"
                                value="{{ auth()->guard('customer')->user()->name }}" readonly="readonly">
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" aria-describedby="emailHelp"
                                value="{{ auth()->guard('customer')->user()->email }}" readonly="readonly">
                            <small id="emailHelp" class="form-text text-muted">We'll never share
                                your email with anyone else.</small>
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="phone" class="form-control" id="phone"
                                value="{{ auth()->guard('customer')->user()->phone }}" readonly="readonly">
                        </div>

                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea class="form-control" id="address" rows="3"
                                readonly="readonly">{{ auth()->guard('customer')->user()->address }}</textarea>
                        </div>
                    @endauth
                </div>

                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                    @auth('customer')
                        <form method="post" action="{{ route('frontendBooking') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" class="form-control" id="room_id" value="{{ $room->id }}"
                                name="room_id">

                            <input type="hidden" class="form-control" id="customer_id"
                                value="{{ auth()->guard('customer')->user()->id }}" name="customer_id">

                            <input type="hidden" class="form-control" value="{{ $booking_date }}" name="booking_date"
                                id="booking_date">

                            <input type="hidden" class="form-control booking_time" id="booking_time" name="booking_time">

                            <button type="submit" class="btn" style="background: #1cc3b2;color: white;"
                                id="bookshow">Book</button>
                        </form>
                    @else
                        <a href="{{ url('customer/login-prev') }}"><button class="btn"
                                style="background: #1cc3b2;color: white;">Login</button></a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            var time1 = $('#time1').val();
            var time2 = $('#time2').val();
            var time3 = $('#time3').val();
            var id = $('#room_id').val();
            var date = $('#booking_date').val();

            $.get("{{ url('getBookingId') }}" + `/${id}/${date}`, function(response) {
                $.each(response, function(i, v) {

                    if (time1 == v.time && date == v.booking_date) {
                        $('#time1').prop('disabled', true);
                    }

                    if (time2 == v.time && date == v.booking_date) {
                        $('#time2').prop('disabled', true);
                    }

                    if (time3 == v.time && date == v.booking_date) {
                        $('#time3').prop('disabled', true);
                    }
                });
            });

            $('.checkout').click(function() {
                var radioValue = $(".radio-btn:checked").val();

                if (radioValue) {
                    $('#bookingFormModal').modal('show');
                } else {
                    $('#selectTimeModal').modal('show');
                }
            });

            $('#bookshow').click(function() {
                var name = $('#name').val();
                var email = $('#email').val();
                var phone = $('#phone').val();
                var address = $('#address').val();
                if (name == "" || email == "" || phone == "" || address == "") {

                } else {
                    $('#bookingFormModal').modal('hide');
                }
            });

            $('#time1').click(function() {
                var radioValue = $(".radio-btn:checked").val();

                $('.booking_time').text(radioValue);
                $('.booking_time').val(radioValue);
            });

            $('#time2').click(function() {
                var radioValue = $(".radio-btn:checked").val();

                $('.booking_time').text(radioValue);
                $('.booking_time').val(radioValue);
            });

            $('#time3').click(function() {
                var radioValue = $(".radio-btn:checked").val();

                $('.booking_time').text(radioValue);
                $('.booking_time').val(radioValue);
            });
        });
    </script>
@endsection
