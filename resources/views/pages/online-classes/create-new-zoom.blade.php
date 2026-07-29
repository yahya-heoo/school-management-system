@extends('layouts.master')
@section('css')

@section('title')
    {{ trans('online_classes_trans.new_zoom_meeting') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0" style="font-family: 'Cairo', sans-serif;">
                {{ trans('online_classes_trans.new_zoom_meeting') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active"> {{ trans('online_classes_trans.new_zoom_meeting') }} </li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="col-xs-12">
                    <div class="col-md-12">
                        <br>
                        <form action="{{ route('online-classes.store') }}" method="POST" autocomplete="off">
                            @csrf
                            <input type="hidden" value="{{ auth()->user()->id }}">

                            <!-- Meeting Details -->
                            <fieldset class="mb-3">
                                <legend>{{ trans('online_classes_trans.meeting_details') }}</legend>
                                <div class="form-row">
                                    <div class="col">
                                        <label for="topic">{{ trans('online_classes_trans.topic') }}</label>
                                        <input type="text" name="topic" class="form-control">
                                        @error('topic')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </fieldset> <hr>

                            <!-- Schedule -->
                            <fieldset class="mb-3">
                                <legend>{{ trans('online_classes_trans.schedule') }}</legend>
                                <div class="form-row">
                                    <div class="form-group col">
                                        <label for="start_time">{{ trans('online_classes_trans.start_time') }}</label>
                                        <input type="datetime-local" name="start_time" class="form-control">
                                        @error('start_time')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col">
                                        <label for="duration">{{ trans('online_classes_trans.duration') }}</label>
                                        <input type="number" min="1" name="duration" placeholder="by minutes..."
                                            class="form-control">
                                        @error('duration')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </fieldset> <hr>

                            <!-- Class Assignment -->
                            <fieldset class="mb-3">
                                <legend>{{ trans('online_classes_trans.class_assignment') }}</legend>
                                <div class="form-row">
                                    <div class="form-group col">
                                        <label for="grade_id">{{ trans('grades_trans.grade') }}</label>
                                        <select class="custom-select my-1 mr-sm-2" name="grade_id">
                                            <option selected disabled>{{ trans('actions_trans.choose') }}...</option>
                                            @foreach ($grades as $grade)
                                                <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('grade_id')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col">
                                        <label for="class_id">{{ trans('classrooms_trans.class') }}</label>
                                        <select class="custom-select my-1 mr-sm-2" name="class_id"></select>
                                        @error('class_id')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col">
                                        <label for="section_id">{{ trans('sections_trans.section') }}</label>
                                        <select class="custom-select my-1 mr-sm-2" name="section_id"></select>
                                        @error('section_id')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </fieldset> <hr>

                            <!-- Submit -->
                            <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">
                                {{ trans('actions_trans.confirm') }}
                            </button>
                        </form>


                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection

@section('js')

<script>
    $(document).ready(function() {
        $('select[name="grade_id"]').on('change', function() {
            var Grade_id = $(this).val();
            if (Grade_id) {
                $.ajax({
                    url: "{{ URL::to('getStudentClasses') }}/" + Grade_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="class_id"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="class_id"]').append(
                                '<option value="' + key + '">' + value +
                                '</option>'
                            );
                        });
                        // Trigger change event to load sections immediately
                        $('select[name="class_id"]').trigger('change');
                    },
                });
            } else {
                console.log('AJAX load did not work');
            }
        });


        $(document).on('change', 'select[name="class_id"]', function() {
            var Class_id = $(this).val();
            if (Class_id) {
                $.ajax({
                    url: "{{ URL::to('getStudentSections') }}/" + Class_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="section_id"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="section_id"]').append(
                                '<option value="' + key + '">' + value +
                                '</option>'
                            );
                        });
                    },
                });
            } else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>



@endsection
