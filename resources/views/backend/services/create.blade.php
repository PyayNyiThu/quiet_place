@extends('backend.layouts.app')

@section('services.active', 'active')

@section('content')

    <div class="container-fluid">
        <div class="card shadow mb-4" id="Newdiv">
            <div class="card-header">
                <div class="row">
                    <div class="col-8">
                        <h4 class="m-0 font-weight-bold text-info mmfont">Add New Service</h4>
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
                        <form method="post" action="{{ route('services.store') }}" class="m-5"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label mmfont"> Name </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="name" placeholder=""
                                        name="name" value="{{ old('name') }}">
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
                                <label for="photo" class="col-sm-2 col-form-label mmfont"> Photo </label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control-file" id="photo"
                                        placeholder="" name="photo">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-save"></i> Create
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
