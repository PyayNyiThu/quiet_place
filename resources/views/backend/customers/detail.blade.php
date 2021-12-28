@extends('backend.layouts.app')

@section('rooms.active', 'active')

@section('content')

    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-8">
                        <h4 class="m-0 font-weight-bold text-info mmfont">User Detail</h4>
                    </div>

                    <div class="offset-2 col-2">
                        {{-- <a href="{{ route('customers.index') }}" class="btn btn-info btn-sm btn-block float-right mmfont">
                            <i class="fas fa-backward"></i>
                            Go Back
                        </a> --}}

                        <button class="btn btn-info btn-sm btn-block float-right back-btn mmfont"><i class="fas fa-backward"></i>
                            Go Back</button>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <th>Type</th>
                            <th>Value</th>
                        </thead>
                        <tbody>
                            <tr>
                                <th>Name</th>
                                <td>{{ $customer->name }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $customer->email }}</td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td>{{ $customer->phone }}</td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td>{{ $customer->address }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
