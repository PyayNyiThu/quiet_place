@extends('backend.layouts.app')

@section('services.active', 'active')

@section('content')

    <div class="container-fluid">
        <!-- Page Heading -->

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-8">
                        <h4 class="m-0 font-weight-bold text-info mmfont">Service List</h4>
                    </div>

                    <div class="offset-2 col-2">
                        <a href="{{ route('services.create') }}" class="btn btn-info btn-sm btn-block float-right mmfont">
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
                                <th>Name</th>
                                <th>Photo</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($services as $row)
                                <tr align="center">
                                    <td class="align-middle">{{ $i++ }}</td>
                                    <td class="align-middle">{{ $row->name }}</td>
                                    <td class="align-middle"><img src="{{ asset($row->photo) }}" width="100" height="100"></td>
                                    <td class="align-middle">
                                        <!-- <a href="#" class="btn btn-outline-success mmfont">
                                          <i class="fas fa-eye"></i> 
                                          Details
                                      </a> -->
                                        <a href="{{ route('services.edit', $row->id) }}"
                                            class="btn btn-outline-primary mr-2 mmfont">
                                            <i class="fas fa-edit"></i>
                                            Edit
                                        </a>

                                        <form method="post" action="{{ route('services.destroy', $row->id) }}"
                                            class="d-inline-block">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-outline-danger mmfont show_confirm"
                                                data-id="{{ $row->id }}"><i class="fas fa-trash"></i> Delete</button>
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

@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $(document).on('click', '.show_confirm', function(e) {
                var form =  $(this).closest("form");
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
