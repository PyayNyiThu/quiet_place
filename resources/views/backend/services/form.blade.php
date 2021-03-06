@extends('backend.layouts.app')

@section('services.active', 'active')

@section('content')

    <div class="container-fluid">
        <div class="card shadow mb-4" id="Newdiv">
            <div class="card-header">
                <div class="row">
                    <div class="col-8">
                        <h4 class="m-0 font-weight-bold text-info mmfont">
                            @if (isset($service))
                            {{__('messages.services.edit_service')}}
                            @else
                            {{__('messages.services.create_service')}}
                            @endif
                        </h4>
                    </div>

                    <div class="offset-2 col-2">
                        <a href="{{ route('services.index') }}" class="btn btn-info btn-sm btn-block float-right">
                            <i class="fas fa-backward"></i>
                            {{__('messages.go_back')}}
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        @if (isset($service))
                            <form method="post" action="{{ route('services.update', $service->id) }}"
                                class="m-5" enctype="multipart/form-data">
                                @method('PUT')
                            @else
                                <form method="post" action="{{ route('services.store') }}" class="m-5"
                                    enctype="multipart/form-data">
                        @endif

                        @csrf

                        <?php
                        $name = old('name') != null ? old('name') : (isset($service) ? $service->name : '');
                        ?>

                        @if (isset($service))
                            <input type="hidden" name="id" value="{{ $service->id }}">
                            <input type="hidden" name="oldphoto" value="{{ $service->photo }}">

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
                                        <img src="{{ asset($service->photo) }}" width="100" height="150"
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
                            <label for="name" class="col-sm-2 col-form-label mmfont"> {{__('messages.name')}} </label>
                            <div class="col-sm-10">
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
                        </div>


                        <div class="form-group row">
                            <div class="offset-2 col-sm-10">

                                <button type="submit" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-save"></i>
                                    @if (isset($service))
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
