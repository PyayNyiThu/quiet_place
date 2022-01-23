@extends('backend.layouts.app')

@section('bookings.active', 'active')

@section('content')

    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-8">
                        <h4 class="m-0 font-weight-bold text-info mmfont">{{__('messages.bookings.bookings_list')}}</h4>
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
                                @if (auth()->user()->can('booking-edit') || auth()->user()->can('booking-delete') || auth()->user()->can('booking-restore'))
                                <th>{{__('messages.action')}}</th>
                                @endif
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
                                        <a href="{{ route('customers.show', $row->customer->id) }}"
                                            class="btn">
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

                                    @if ($row->status == 1)
                                        <td class="align-middle text-primary"><a
                                                href="{{ url('admin/change-status/' . $row->id) }}">New Booking</a></td>
                                    @else
                                        <td class="align-middle text-success">Read Booking</td>
                                    @endif

                                    @if (auth()->user()->can('booking-edit') || auth()->user()->can('booking-delete') || auth()->user()->can('booking-restore'))
                                        <td class="align-middle">
                                            @if ($row->trashed())
                                                @can('booking-restore')
                                                    <a href="{{ route('bookings.restore', $row->id) }}"
                                                        class="btn btn-outline-warning mr-2 mmfont restore_confirm" title="{{__('messages.restore')}}">
                                                        <i class="fas fa-trash-restore"></i>
                                                    </a>
                                                @endcan
                                                
                                            @else
                                                <a href="{{ route('bookings.show', $row->id) }}"
                                                    class="btn btn-outline-success mmfont mb-2" title="{{__('messages.detail')}}">
                                                    <i class="fas fa-eye"></i>
                                                </a>

                                                @can('booking-edit')
                                                    <a href="{{ route('bookings.edit', $row->id) }}"
                                                        class="btn btn-outline-primary mmfont mb-2" title="{{__('messages.edit')}}">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                @endcan

                                                <form method="post" action="{{ route('bookings.destroy', $row->id) }}"
                                                    class="d-inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    @can('booking-delete')

                                                        @if (!$row->trashed())

                                                            <button type="submit"
                                                                class="btn btn-outline-danger mmfont delete_confirm" title="{{__('messages.delete')}}"><i
                                                                    class="fas fa-trash"></i></button>
                                                        @endif
                                                    @endcan
                                                </form>                                          
                                            @endif
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    {{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> --}}


@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $(document).on('click', '.delete_confirm', function(e) {
                var form = $(this).closest("form");
                e.preventDefault();

                Swal.fire({
                    title: "{{__('messages.are_you_sure_you_want_to_delete')}}",
                    showCancelButton: true,
                    cancelButtonText: `{{__('messages.cancel')}}`,
                    confirmButtonText: `{{__('messages.confirm')}}`,
                    reverseButtons: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                })
            });

            $(document).on('click', '.restore_confirm', function(e) {
                const url = $(this).attr('href');
                e.preventDefault();

                Swal.fire({
                    title: "{{__('messages.are_you_sure_you_want_to_restore')}}",
                    showCancelButton: true,
                    cancelButtonText: `{{__('messages.cancel')}}`,
                    confirmButtonText: `{{__('messages.confirm')}}`,
                    reverseButtons: true,
                    reverseButtons: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.href = url;
                    }
                })
            });
        });
    </script>

@endsection
