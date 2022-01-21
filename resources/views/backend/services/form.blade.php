@extends('backend.layouts.app')

@section('services.active', 'active')

@section('content')

    <div class="container-fluid">
        <div class="card shadow mb-4" id="Newdiv">
            <div class="card-header">
                <div class="row">
                    <div class="col-8">
                        <h4 class="m-0 font-weight-bold text-info mmfont">Update Existing Service</h4>
                    </div>

                    <div class="offset-2 col-2">
                        <a href="{{ route('services.index') }}" class="btn btn-info btn-sm btn-block float-right">
                            <i class="fas fa-backward"></i>
                            Go Back
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form method="post" action="{{ route('services.update', $service->id) }}" class="m-5"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <input type="hidden" name="id" value="{{ $service->id }}">
                            <input type="hidden" name="oldphoto" value="{{ $service->photo }}">
                            <div class="form-group row">
                                <label for="profile" class="col-sm-2 col-form-label">Profile</label>
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab"
                                            href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Old
                                            Profile</a>
                                        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab"
                                            href="#nav-profile" role="tab" aria-controls="nav-profile"
                                            aria-selected="false">New Profile</a>
                                    </div>
                                </nav>
                            </div>

                            <div class="form-group row">
                                <label for="photo" class="col-sm-2 col-form-label mmfont"> Photo </label>
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

                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label mmfont"> Name </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="name" placeholder=""
                                        name="name" value="{{ $service->name }}">
                                    @error('name')
                                        <div class=" alert alert-danger">
                                            <ul>
                                                <li>{{ $message }}</li>
                                            </ul>
                                        </div>
                                    @enderror
                                </div>
                            </div>


                            <button type="submit" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-save"></i> Update
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
