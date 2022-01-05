@extends('backend.layouts.app')

@section('roles.active', 'active')

@section('content')

    <div class="container-fluid">
        <!-- Page Heading -->

        {{-- @if (Session::has('create'))
            <div class="alert alert-primary alert-icon alert-icon-border alert-dismissible" role="alert">
                <div class="icon"><span class="mdi mdi-check"></span></div>
                <div class="message">
                    <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span
                            class="mdi mdi-close" aria-hidden="true"></span></button>{{ session('create') }}
                </div>
            </div>
        @endif --}}

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-8">
                        <h4 class="m-0 font-weight-bold text-info mmfont">Role List</h4>
                    </div>

                    <div class="offset-2 col-2">
                        @can('role-create')
                        <a href="{{ route('roles.create') }}" class="btn btn-info btn-sm btn-block float-right mmfont">
                            <i class="fas fa-plus"></i>
                            Add New
                        </a>
                        @endcan
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr align="center">
                                <th>No</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($roles as $row)
                                <tr align="center">
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $row->name }}</td>
                                    <td>
                                        <!-- <a href="#" class="btn btn-outline-success mmfont">
                                                                <i class="fas fa-eye"></i> 
                                                                Details
                                                                </a> -->
                                        @can('role-edit')
                                            <a href="{{ route('roles.edit', $row->id) }}"
                                                class="btn btn-outline-primary mr-2 mmfont">
                                                <i class="fas fa-edit"></i>
                                                Edit
                                            </a>
                                        @endcan

                                        <form method="post" action="{{ route('roles.destroy', $row->id) }}"
                                            class="d-inline-block" id="form">
                                            @csrf
                                            @method('DELETE')

                                            @can('role-delete')
                                                <button type="submit" class="btn btn-outline-danger mmfont show_confirm"
                                                    data-id="{{ $row->id }}"><i class="fas fa-trash"></i> Delete</button>
                                            @endcan
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
