@extends('backend.layouts.app')

@section('townships.active', 'active')

@section('content')

    <div class="container-fluid">
        <div class="card shadow mb-4" id="Newdiv">
            <div class="card-header">
                <div class="row">
                    <div class="col-8">
                        <h4 class="m-0 font-weight-bold text-info mmfont">Update Existing Township</h4>
                    </div>

                    <div class="offset-2 col-2">
                        <a href="{{ route('townships.index') }}" class="btn btn-info btn-sm btn-block float-right">
                            <i class="fas fa-backward"></i>
                            Go Back
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form method="post" action="{{ route('townships.update', $township->id) }}" class="m-5">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name" class="mmfont"> Name </label>
                                <input type="text" class="form-control" id="name" placeholder=""
                                    name="name" value="{{ $township->name }}">
                                @error('name')
                                    <div class=" alert alert-danger">
                                        <ul>
                                            <li>{{ $message }}</li>
                                        </ul>
                                    </div>
                                @enderror
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
