@extends('backend.layouts.app')

@section('customers.active', 'active')

@section('content')

    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-8">
                        <h4 class="m-0 font-weight-bold text-info mmfont">{{__('messages.customers.customers_list')}}</h4>
                    </div>

                    <div class="offset-2 col-2">
                        @can('customer-create')
                            <a href="{{ route('customers.create') }}" class="btn btn-info btn-sm btn-block float-right mmfont">
                                <i class="fas fa-plus"></i>
                                {{__('messages.add_new')}}
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
                                <th>{{__('messages.no')}}</th>
                                <th>{{__('messages.name')}}</th>
                                <th>{{__('messages.email')}}</th>
                                <th>{{__('messages.phone')}}</th>
                                <th>{{__('messages.address')}}</th>
                                <th>{{__('messages.status')}}</th>
                                @if (auth()->user()->can('customer-edit') || auth()->user()->can('customer-delete') || auth()->user()->can('customer-restore'))
                                <th>{{__('messages.action')}}</th>
                                @endif
                            </tr>
                        </thead>

                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($customers as $row)
                                <tr align="center">
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->email }}</td>
                                    <td>{{ $row->phone }}</td>
                                    <td>{{ $row->address }}</td>

                                    <td>
                                        @if($row->status == 'active')
                                            <label class="badge badge-success">Active</label>
                                        @elseif($row->status == 'banned')
                                            <label class="badge badge-danger">Banned</label>
                                        @else
                                            <label class="badge badge-warning">Locked</label>
                                        @endif
                                    </td>

                                    @if (auth()->user()->can('customer-edit') || auth()->user()->can('customer-delete') || auth()->user()->can('customer-restore'))
                                        <td>

                                            @if ($row->trashed())
                                                @can('customer-restore')
                                                    <a href="{{ route('customers.restore', $row->id) }}"
                                                        class="btn btn-outline-warning mr-2 mmfont restore_confirm" title="{{__('messages.restore')}}">
                                                        <i class="fas fa-trash-restore"></i>
                                                    </a>
                                                @endcan

                                            @else

                                                @can('customer-edit')
                                                    <a href="{{ route('customers.edit', $row->id) }}"
                                                        class="btn btn-outline-primary mr-2 mmfont" title="{{__('messages.edit')}}">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                @endcan

                                                <form method="post" action="{{ route('customers.destroy', $row->id) }}"
                                                    class="d-inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    @can('customer-delete')
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
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.href = url;
                    }
                })
            });
        });
    </script>

@endsection
