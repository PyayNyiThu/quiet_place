@extends('backend.layouts.app')

@section('rooms.active', 'active')

@section('content')

    <div class="container-fluid">
        <div class="card shadow mb-4" id="Newdiv">
            <div class="card-header">
                <div class="row">
                    <div class="col-8">
                        <h4 class="m-0 font-weight-bold text-info mmfont">Add Room</h4>
                    </div>

                    <div class="offset-2 col-2">
                        <a href="{{ route('rooms.index') }}" class="btn btn-info btn-sm btn-block float-right">
                            <i class="fas fa-backward"></i>
                            Go Back
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form method="post" action="{{ route('rooms.store') }}" class="m-5"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="price" class="col-sm-2 col-form-label mmfont"> Price </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="price" placeholder=""
                                        name="price" value="{{ old('price') }}">
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
                                <label for="photo" class="col-sm-2 col-form-label mmfont"> Photo </label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control-file" id="photo"
                                        placeholder="" name="photo">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description" class="col-sm-2 col-form-label mmfont"> Description </label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="description" rows="3"
                                        name="description">{{ old('description') }}</textarea>

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
                                <label for="roomtype_id" class="col-sm-2 col-form-label mmfont"> Room Type</label>
                                <div class="col-sm-10">
                                    <select name="roomtype_id" class="custom-select" id="roomtype_id">
                                        @foreach ($roomtype as $row)
                                            <option value="{{ $row->id }}">{{ $row->name }}</option>
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
                                <div class="col-sm-2">Service</div>
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        @foreach ($service as $subject)
                                            <input class="form-check-input" type="checkbox"
                                                id="gridCheck{{ $subject->id }}" value="{{ $subject->id }}"
                                                name="services[]">
                                            <label for="gridCheck{{ $subject->id }}"
                                                class="mr-4 form-check-label">{{ $subject->name }}</label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="township_id" class="col-sm-2 col-form-label mmfont"> Township </label>
                                <div class="col-sm-10">
                                    <select name="township_id" class="custom-select" id="township_id">
                                        @foreach ($township as $row)
                                            <option value="{{ $row->id }}">{{ $row->name }}</option>
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
                                <label for="size" class="col-sm-2 col-form-label mmfont"> Size </label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="size" placeholder=""
                                        name="size" value="{{ old('size') }}">
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
                                <label for="capacity" class="col-sm-2 col-form-label mmfont"> Capacity </label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="capacity" placeholder=""
                                        name="capacity" value="{{ old('capacity') }}">
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
                                        <i class="fas fa-save"></i> Create
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
