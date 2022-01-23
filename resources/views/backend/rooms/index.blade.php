@extends('backend.layouts.app')

@section('rooms.active', 'active')

@section('content')

    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-8">
                        <h4 class="m-0 font-weight-bold text-info mmfont">{{__('messages.rooms.rooms_list')}}</h4>
                    </div>

                    <div class="offset-2 col-2">
                        @can('room-create')
                            <a href="{{ route('rooms.create') }}" class="btn btn-info btn-sm btn-block float-right mmfont">
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
                                <th>{{__('messages.price')}}</th>
                                <th>{{__('messages.photo')}}</th>
                                <th>{{__('messages.rooms.description')}}</th>
                                <th>{{__('messages.rooms.room_type')}}</th>
                                <th>{{__('messages.township')}}</th>
                                <th>{{__('messages.size')}}</th>
                                <th>{{__('messages.capacity')}}</th>
                                <th>{{__('messages.rooms.service')}}</th>
                                @if (auth()->user()->can('room-edit') || auth()->user()->can('room-delete') || auth()->user()->can('room-restore'))
                                    <th>{{__('messages.action')}}</th>
                                @endif
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
                                    <td>{{ $row->roomtype->name }}</td>
                                    <td>{{ $row->township->name }}</td>
                                    <td>{{ $row->size }}</td>
                                    <td>{{ $row->capacity }}</td>
                                    <td>
                                        @foreach ($row->services as $service)
                                            {{ $service->name }} ,
                                        @endforeach
                                    </td>

                                    @if (auth()->user()->can('room-edit') || auth()->user()->can('room-delete') || auth()->user()->can('room-restore'))
                                        <td>

                                            @if ($row->trashed())
                                                @can('room-restore')
                                                    <a href="{{ route('rooms.restore', $row->id) }}"
                                                        class="btn btn-outline-warning mr-2 mmfont restore_confirm" title="{{__('messages.restore')}}">
                                                        <i class="fas fa-trash-restore"></i>
                                                    </a>
                                                @endcan
                                            
                                            @else

                                                <a href="{{ route('rooms.show', $row->id) }}"
                                                    class="btn btn-outline-success mb-2 mmfont" title="{{__('messages.detail')}}">
                                                    <i class="fas fa-eye"></i>
                                                </a>

                                                @can('room-create')
                                                    <a href="{{ route('rooms.edit', $row->id) }}"
                                                        class="btn btn-outline-primary mb-2 mmfont" title="{{__('messages.edit')}}">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                @endcan

                                                <form method="post" action="{{ route('rooms.destroy', $row->id) }}"
                                                    class="d-inline-block">
                                                    @csrf
                                                    @method('DELETE')

                                                    @can('room-delete')
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
