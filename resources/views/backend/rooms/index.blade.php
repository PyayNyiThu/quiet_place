@extends('backend.layouts.app')

@section('rooms.active', 'active')

@section('content')

    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-8">
                        <h4 class="m-0 font-weight-bold text-info mmfont">Room List</h4>
                    </div>

                    <div class="offset-2 col-2">
                        <a href="{{ route('rooms.create') }}" class="btn btn-info btn-sm btn-block float-right mmfont">
                            <i class="fas fa-plus"></i>
                            Add New
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr align="center">
                                <th>No</th>
                                <th>Price</th>
                                <th>Photo</th>
                                <th>Description</th>
                                <th>Room Type</th>
                                <th>Township</th>
                                <th>Size</th>
                                <th>Capacity</th>
                                <th>Service</th>
                                <td align="center"><b>Action</b></td>
                            </tr>
                        </thead>

                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($rooms as $row)
                                <tr align="center">
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $row->price }} MMK</td>
                                    <td><img src="{{ asset($row->photo) }}" width="100" height="100"></td>
                                    <td>{{ $row->description }}</td>
                                    <td>{{ $row->roomtype->name}}</td>
                                    <td>{{ $row->township->name }}</td>
                                    <td>{{ $row->size }}</td>
                                    <td>{{ $row->capacity }}</td>
                                    <td>
                                        @foreach ($row->services as $service)
                                            {{ $service->name }} ,
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="{{ route('rooms.show', $row->id) }}" class="btn btn-outline-success mb-2 mmfont">
                                            <i class="fas fa-eye"></i>
                                            Details
                                        </a>
                                        <a href="{{ route('rooms.edit', $row->id) }}" class="btn btn-outline-primary mb-2 mmfont">
                                            <i class="fas fa-edit"></i>
                                            Edit
                                        </a>

                                        <form method="post" action="{{ route('rooms.destroy', $row->id) }}"
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