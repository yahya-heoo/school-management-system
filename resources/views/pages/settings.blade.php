@extends('layouts.master')
@section('css')

@section('title')
    {{ trans('main_sidebar_trans.settings') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0" style="font-family: 'Cairo', sans-serif;"> {{ trans('main_sidebar_trans.settings') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active">{{ trans('main_sidebar_trans.settings') }}</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-12 mb-30">
        <div class="card card-statistics card-shadow h-100">
            <div class="card-body">
                <form action="{{ route('settings.update', 'test') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <!-- First Column -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="current_session"
                                    class="form-label">{{ trans('settings_trans.current_session') }}</label>
                                <input type="text" name="current_session" class="form-control"
                                    value="{{ old('current_session', $settings['current_session'] ?? '') }}">
                                @error('current_session')
                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="school_title"
                                    class="form-label">{{ trans('settings_trans.school_title') }}</label>
                                <input type="text" name="school_title" class="form-control"
                                    value="{{ old('school_title', $settings['school_title'] ?? '') }}">
                                @error('school_title')
                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="school_name"
                                    class="form-label">{{ trans('settings_trans.school_name') }}</label>
                                <input type="text" name="school_name" class="form-control"
                                    value="{{ old('school_name', $settings['school_name'] ?? '') }}">
                                @error('school_name')
                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="school_email"
                                    class="form-label">{{ trans('settings_trans.school_email') }}</label>
                                <input type="text" name="school_email" class="form-control"
                                    value="{{ old('school_email', $settings['school_email'] ?? '') }}">
                                @error('school_email')
                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="logo" class="form-label">{{ trans('settings_trans.logo') }}</label>
                                <input type="file" name="logo" class="form-control" accept="image/*">
                                @error('logo')
                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Second Column -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="end_first_term"
                                    class="form-label">{{ trans('settings_trans.end_first_term') }}</label>
                                <input type="text" name="end_first_term" class="form-control"
                                    value="{{ old('end_first_term', $settings['end_first_term'] ?? '') }}">
                                @error('end_first_term')
                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="end_second_term"
                                    class="form-label">{{ trans('settings_trans.end_second_term') }}</label>
                                <input type="text" name="end_second_term" class="form-control"
                                    value="{{ old('end_second_term', $settings['end_second_term'] ?? '') }}">
                                @error('end_second_term')
                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label">{{ trans('settings_trans.address') }}</label>
                                <input type="text" name="address" class="form-control"
                                    value="{{ old('address', $settings['address'] ?? '') }}">
                                @error('address')
                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">{{ trans('settings_trans.phone') }}</label>
                                <input type="text" name="phone" class="form-control"
                                    value="{{ old('phone', $settings['phone'] ?? '') }}">
                                @error('phone')
                                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>


                    </div>

                    <hr class="mt-4">

                    <div class="d-flex justify-content-end mt-3">
                        <button class="btn btn-success btn-lg" type="submit">
                            {{ trans('actions_trans.confirm') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
