@extends('backend.layouts.app')

@section('rooms.active', 'active')

@section('content')

    <div class="container-fluid">
        <div class="card shadow mb-4" id="Newdiv">
            <div class="card-header">
                <div class="row">
                    <div class="col-8">
                        <h4 class="m-0 font-weight-bold text-info mmfont">
                            @if (isset($room))
                            {{__('messages.rooms.edit_room')}}
                            @else
                            {{__('messages.rooms.create_room')}}
                            @endif
                        </h4>
                    </div>

                    <div class="offset-2 col-2">
                        <a href="{{ route('rooms.index') }}" class="btn btn-info btn-sm btn-block float-right">
                            <i class="fas fa-backward"></i>
                            {{__('messages.go_back')}}
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        @if (isset($room))
                            <form method="post" action="{{ route('rooms.update', $room->id) }}" class="m-5"
                                enctype="multipart/form-data">
                                @method('PUT')

                            @else
                                <form method="post" action="{{ route('rooms.store') }}" class="m-5"
                                    enctype="multipart/form-data">
                        @endif

                        @csrf

                        <?php
                        $price = old('price') != null ? old('price') : (isset($room) ? $room->price : '');
                        $description = old('description') != null ? old('description') : (isset($room) ? $room->description : '');
                        $size = old('size') != null ? old('size') : (isset($room) ? $room->size : '');
                        $capacity = old('capacity') != null ? old('capacity') : (isset($room) ? $room->capacity : '');
                        ?>

                        @if (isset($room))
                            <input type="hidden" name="id" value="{{ $room->id }}">
                            <input type="hidden" name="oldphoto" value="{{ $room->photo }}">

                            <div class="form-group row">
                                <label for="profile" class="col-sm-2 col-form-label">{{__('messages.profile')}}</label>
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab"
                                            href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">{{__('messages.old_profile')}}</a>
                                        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab"
                                            href="#nav-profile" role="tab" aria-controls="nav-profile"
                                            aria-selected="false">{{__('messages.new_profile')}}</a>
                                    </div>
                                </nav>
                            </div>

                            <div class="form-group row">
                                <label for="photo" class="col-sm-2 col-form-label mmfont"> {{__('messages.photo')}} </label>
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active col-sm-10" id="nav-home" role="tabpanel"
                                        aria-labelledby="nav-home-tab">
                                        <img src="{{ asset($room->photo) }}" width="100" height="150"
                                            class="img-fluid " id="photo">
                                    </div>
                                    <div class="tab-pane fade" id="nav-profile" role="tabpanel"
                                        aria-labelledby="nav-profile-tab">
                                        <input type="file" class="form-control-file" id="newphoto" name="photo">
                                    </div>
                                </div>
                            </div>

                        @else
                            <div class="form-group row">
                                <label for="photo" class="col-sm-2 col-form-label mmfont"> {{__('messages.photo')}} </label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control-file" id="photo" placeholder="" name="photo">

                                    @error('photo')
                                        <div class=" alert alert-danger">
                                            <ul>
                                                <li>{{ $message }}</li>
                                            </ul>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        @endif

                        <div class="form-group row">
                            <label for="price" class="col-sm-2 col-form-label mmfont"> {{__('messages.price')}} </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="price" placeholder="" name="price"
                                    value="{{ $price }}">
                                @error('price')
                                    <div class=" alert alert-danger">
                                        <ul>
                                            <li>{{ $message }}</li>
                                        </ul>
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-sm-2 col-form-label mmfont"> {{__('messages.rooms.description')}} </label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="description" rows="3"
                                    name="description">{{ $description }}</textarea>

                                @error('description')
                                    <div class=" alert alert-danger">
                                        <ul>
                                            <li>{{ $message }}</li>
                                        </ul>
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="roomtype_id" class="col-sm-2 col-form-label mmfont"> {{__('messages.rooms.room_type')}} </label>
                            <div class="col-sm-10">
                                <select name="roomtype_id" class="custom-select" id="roomtype_id">
                                    @foreach ($roomtype as $row)
                                        @if (isset($room))
                                            <option value="{{ $row->id }}"
                                                {{ $room->roomtype_id == $row->id ? 'selected' : '' }}>
                                                {{ $row->name }}
                                            </option>
                                        @else
                                            <option value="{{ $row->id }}"
                                                {{ old('roomtype_id') == $row->id ? 'selected' : '' }}>
                                                {{ $row->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('roomtype_id')
                                    <div class=" alert alert-danger">
                                        <ul>
                                            <li>{{ $message }}</li>
                                        </ul>
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="township_id" class="col-sm-2 col-form-label mmfont"> {{__('messages.township')}} </label>
                            <div class="col-sm-10">
                                <select name="township_id" class="custom-select" id="township_id">
                                    @foreach ($township as $row)
                                        @if (isset($room))
                                            <option value="{{ $row->id }}"
                                                {{ $room->township_id == $row->id ? 'selected' : '' }}>
                                                {{ $row->name }}
                                            </option>
                                        @else
                                            <option value="{{ $row->id }}"
                                                {{ old('township_id') == $row->id ? 'selected' : '' }}>
                                                {{ $row->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('township_id')
                                    <div class=" alert alert-danger">
                                        <ul>
                                            <li>{{ $message }}</li>
                                        </ul>
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-2">{{__('messages.rooms.service')}}</div>
                            <div class="col-sm-10">
                                <div class="form-check">
                                    @foreach ($service as $subject)
                                        @if (isset($room))
                                            <input class="form-check-input" type="checkbox"
                                                id="gridCheck{{ $subject->id }}" value="{{ $subject->id }}"
                                                name="services[]" @foreach ($room_service as $rs)
                                            @if ($rs->id == $subject->id)
                                                checked
                                            @endif

                                        @endforeach >

                                    @else
                                        <input class="form-check-input" type="checkbox" id="gridCheck{{ $subject->id }}"
                                            value="{{ $subject->id }}" name="services[]">
                                    @endif
                                    <label for="gridCheck{{ $subject->id }}"
                                        class="mr-4 form-check-label">{{ $subject->name }}</label>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="size" class="col-sm-2 col-form-label mmfont"> {{__('messages.size')}} </label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="size" placeholder="" name="size"
                                    value="{{ $size }}">
                                @error('size')
                                    <div class=" alert alert-danger">
                                        <ul>
                                            <li>{{ $message }}</li>
                                        </ul>
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="capacity" class="col-sm-2 col-form-label mmfont"> {{__('messages.capacity')}} </label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="capacity" placeholder="" name="capacity"
                                    value="{{ $capacity }}">
                                @error('capacity')
                                    <div class=" alert alert-danger">
                                        <ul>
                                            <li>{{ $message }}</li>
                                        </ul>
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="offset-2 col-sm-10">

                                <button type="submit" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-save"></i>
                                    @if (isset($room))
                                    {{__('messages.update')}}
                                    @else
                                    {{__('messages.create')}}
                                    @endif
                                </button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
