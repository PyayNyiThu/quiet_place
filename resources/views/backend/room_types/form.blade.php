@extends('backend.layouts.app')

@section('room-types.active', 'active')

@section('content')

    <div class="container-fluid">
        <div class="card shadow mb-4" id="Newdiv">
            <div class="card-header">
                <div class="row">
                    <div class="col-8">
                        <h4 class="m-0 font-weight-bold text-info mmfont">
                            @if (isset($room_type))
                                Update Existing Room Type
                            @else
                                Add New Room Type
                            @endif
                        </h4>
                    </div>
                    <div class="offset-2 col-2">
                        <a href="{{ route('room-types.index') }}" class="btn btn-info btn-sm btn-block float-right">
                            <i class="fas fa-backward"></i>
                            Go Back
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        @if (isset($room_type))
                            <form method="post" action="{{ route('room-types.update', $room_type->id) }}"
                                class="m-5">
                                @method('PUT')
                            @else
                                <form method="post" action="{{ route('room-types.store') }}" class="m-5"
                                    enctype="multipart/form-data">
                        @endif

                        @csrf

                        <?php
                            $name = old('name') != null ? old('name') : (isset($room_type) ? $room_type->name : '');
                        ?>

                        <div class="form-group">
                            <label for="name" class="mmfont"> Name </label>
                            <input type="text" class="form-control" id="name" placeholder="" name="name"
                                value="{{ $name }}">
                            @error('name')
                                <div class=" alert alert-danger">
                                    <ul>
                                        <li>{{ $message }}</li>
                                    </ul>
                                </div>
                            @enderror
                        </div>


                        <button type="submit" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-save"></i>
                            @if (isset($room_type))
                                Update
                            @else
                                Create
                            @endif
                        </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
