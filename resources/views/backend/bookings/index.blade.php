@extends('backend.layouts.app')

@section('bookings.active', 'active')

@section('content')

    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-8">
                        <h4 class="m-0 font-weight-bold text-info mmfont">Booking List</h4>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr align="center">
                                <th>No</th>
                                <th>Booking No</th>
                                <th>Customer Data</th>
                                <th>Room Data</th>
                                <th>Booking Date</th>
                                <th>Time</th>
                                <th>Status</th>
                                <th>Action</th>
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
                                    {{-- <td>
                                        @foreach ($row->services as $service)
                                            {{ $service->name }} ,
                                        @endforeach
                                    </td> --}}
                                    <td class="align-middle">
                                        <a href="{{ route('bookings.show', $row->id) }}"
                                            class="btn btn-outline-success mmfont mb-2">
                                            <i class="fas fa-eye"></i>
                                            Details
                                        </a>
                                        <a href="{{ route('bookings.edit', $row->id) }}"
                                            class="btn btn-outline-primary mmfont mb-2">
                                            <i class="fas fa-edit"></i>
                                            Edit
                                        </a>

                                        <form method="post" action="{{ route('bookings.destroy', $row->id) }}"
                                            class="d-inline-block">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-outline-danger mmfont show_confirm"><i
                                                    class="fas fa-trash"></i> Delete</button>
                                        </form>
                                    </td>
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
            $(document).on('click', '.show_confirm', function(e) {
                var form = $(this).closest("form");
                e.preventDefault();

                Swal.fire({
                    title: 'Are you sure, you want to delete?',
                    showCancelButton: true,
                    confirmButtonText: `Confirm`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                })
            });
        });
    </script>

@endsection
