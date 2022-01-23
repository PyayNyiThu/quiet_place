@extends('backend.layouts.app')

@section('rooms.active', 'active')

@section('content')

    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-8">
                        <h4 class="m-0 font-weight-bold text-info mmfont">{{__('messages.customers.customer_detail')}}</h4>
                    </div>

                    <div class="offset-2 col-2">
                        {{-- <a href="{{ route('customers.index') }}" class="btn btn-info btn-sm btn-block float-right mmfont">
                            <i class="fas fa-backward"></i>
                            Go Back
                        </a> --}}

                        <button class="btn btn-info btn-sm btn-block float-right back-btn mmfont"><i class="fas fa-backward"></i>
                            {{__('messages.go_back')}}
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
                                <td>{{__('messages.name')}}</td>
                                <td>{{ $customer->name }}</td>
                            </tr>
                            <tr>
                                <td>{{__('messages.email')}}</td>
                                <td>{{ $customer->email }}</td>
                            </tr>
                            <tr>
                                <td>{{__('messages.phone')}}</td>
                                <td>{{ $customer->phone }}</td>
                            </tr>
                            <tr>
                                <td>{{__('messages.address')}}</td>
                                <td>{{ $customer->address }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
