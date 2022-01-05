@extends('backend.layouts.app')

@section('roles.active', 'active')

@section('content')

    <div class="container-fluid">
        <div class="card shadow mb-4" id="Newdiv">
            <div class="card-header">
                <div class="row">
                    <div class="col-8">
                        <h4 class="m-0 font-weight-bold text-info mmfont">Add New Role</h4>
                    </div>

                    <div class="offset-2 col-2">
                        <a href="{{ route('roles.index') }}" class="btn btn-info btn-sm btn-block float-right">
                            <i class="fas fa-backward"></i>
                            Go Back
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form method="post" action="{{ route('roles.store') }}" class="m-5"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name" class="mmfont"> Name </label>
                                <input type="text" class="form-control" id="name" placeholder="" name="name"
                                    value="{{ old('name') }}">
                                @error('name')
                                    <div class=" alert alert-danger">
                                        <ul>
                                            <li>{{ $message }}</li>
                                        </ul>
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-2">Permission</div>
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        @php
                                            $i = 1;
                                        @endphp

                                        @foreach ($permission as $value)
                                            <input class="form-check-input" type="checkbox"
                                                id="gridCheck{{ $value->id }}" value="{{ $value->id }}"
                                                name="permission[]">
                                            <label for="gridCheck{{ $value->id }}"
                                                class="mr-4 form-check-label">{{ $value->name }}</label>
                                            @php
                                                $i ++;
                                                if($i == 6) {
                                                    echo "<br>";
                                                    $i = 1;
                                                }
                                            @endphp
                                        @endforeach
                                    </div>
                                    {{-- @foreach ($permission as $value)
                                        <label>{{ Form::checkbox('permission[]', $value->id, false, ['class' => 'name']) }}
                                            {{ $value->name }}</label>
                                        <br />
                                    @endforeach --}}
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
