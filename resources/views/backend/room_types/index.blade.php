@extends('backend.layouts.app')

@section('room-types.active', 'active')

@section('content')

    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-8">
                        <h4 class="m-0 font-weight-bold text-info mmfont">{{__('messages.room_types.room_types_list')}}</h4>
                    </div>

                    <div class="offset-2 col-2">
                        @can('room_type-create')
                            <a href="{{ route('room-types.create') }}"
                                class="btn btn-info btn-sm btn-block float-right mmfont">
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
                                @if (auth()->user()->can('room_type-edit') || auth()->user()->can('room_type-delete') || auth()->user()->can('room_type-restore'))
                                <th>{{__('messages.action')}}</th>
                                @endif
                            </tr>
                        </thead>

                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($room_types as $row)
                                <tr align="center">
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $row->name }}</td>

                                    @if (auth()->user()->can('room_type-edit') || auth()->user()->can('room_type-delete') || auth()->user()->can('room_type-restore'))
                                    <td>

                                        @if ($row->trashed())
                                            @can('room_type-restore')
                                                <a href="{{ route('room-types.restore', $row->id) }}"
                                                    class="btn btn-outline-warning mr-2 mmfont restore_confirm" title="{{__('messages.restore')}}">
                                                    <i class="fas fa-trash-restore"></i>
                                                </a>
                                            @endcan

                                        @else

                                            <!-- <a href="#" class="btn btn-outline-success mmfont">
                                                <i class="fas fa-eye"></i> 
                                                Details
                                            </a> -->
                                            @can('room_type-edit')
                                                <a href="{{ route('room-types.edit', $row->id) }}"
                                                    class="btn btn-outline-primary mr-2 mmfont" title="{{__('messages.edit')}}">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            @endcan

                                            <form method="post" action="{{ route('room-types.destroy', $row->id) }}"
                                                class="d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                @can('room_type-delete')
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
