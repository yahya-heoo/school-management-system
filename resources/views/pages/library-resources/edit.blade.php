@extends('layouts.master')
@section('css')

@section('title')
    {{ trans('library_trans.edit_resource') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0" style="font-family: 'Cairo', sans-serif;"> {{ trans('library_trans.edit_resource') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active"> {{ trans('library_trans.edit_resource') }} </li>
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
                        <form action="{{ route('library-resources.update', $library_resource->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="form-row mb-2">
                                <div class="col">
                                    <input type="hidden" name ="id" value="{{$library_resource->id}}">
                                    <label for="title">{{ trans('library_trans.resource_title') }}</label>
                                    <input type="text" name="title" class="form-control"
                                        value="{{ $library_resource->title }}">
                                    @error('title')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>

                            <hr>


                            <div class="form-row">

                                <div class="form-group col ">
                                    <label for="grade_id" class="form-label">{{ trans('grades_trans.grade') }}</label>
                                    <select class="form-control py-2 my-1 mr-sm-2" name="grade_id"
                                        onchange="console.log($(this).val())">
                                        <option selected disabled>{{ trans('actions_trans.choose') }}...</option>
                                        @foreach ($grades as $grade)
                                            <option value="{{ $grade->id }}"
                                                {{ $library_resource->grade_id == $grade->id ? 'selected' : '' }}>
                                                {{ $grade->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('grade_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col ">
                                    <label for="class_id"
                                        class="form-label">{{ trans('classrooms_trans.class') }}</label>
                                    <select class="form-control py-2 my-1 mr-sm-2" name="class_id"
                                        onchange="console.log($(this).val())">

                                    </select>
                                    @error('class_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col ">
                                    <label for="section_id"
                                        class="form-label">{{ trans('sections_trans.section') }}</label>
                                    <select class="form-control py-2 my-1 mr-sm-2" name="section_id">

                                    </select>
                                    @error('section_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="attachment"
                                        class="form-label">{{ trans('students_trans.attachments') }}</label>
                                    <input type="file" name="attachment" class="form-control">
                                    @error('attachment')
                                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <hr>



                            <button class="btn btn-success btn-sm nextBtn btn-lg pull-right"
                                type="submit">{{ trans('actions_trans.confirm') }}</button>

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
        // Retrieve current student data from Blade
        var current_grade_id = {{ $library_resource->grade_id }};
        var current_class_id = {{ $library_resource->class_id }};
        var current_section_id = {{ $library_resource->section_id }};


        // Function to load classes via AJAX
        function loadClasses(gradeId) {
            return $.ajax({
                url: "{{ URL::to('getStudentClasses') }}/" + gradeId,
                type: "GET",
                dataType: "json"
            });
        }

        function loadSections(classId) {
            return $.ajax({
                url: "{{ URL::to('getStudentSections') }}/" + classId,
                type: "GET",
                dataType: "json"
            });
        }

        $('select[name="grade_id"]').on('change', function() {
            var gradeId = $(this).val();
            if (gradeId) {
                loadClasses(gradeId).done(function(data) {
                    var classSelect = $('select[name="class_id"]');
                    classSelect.empty();
                    $.each(data, function(key, value) {
                        classSelect.append($('<option>', {
                            value: key,
                            text: value
                        }));
                    });
                    classSelect.trigger('change');
                });
            }
        });

        $('select[name="class_id"]').on('change', function() {
            var classId = $(this).val();
            if (classId) {
                loadSections(classId).done(function(data) {
                    var sectionSelect = $('select[name="section_id"]');
                    sectionSelect.empty();
                    $.each(data, function(key, value) {
                        sectionSelect.append($('<option>', {
                            value: key,
                            text: value
                        }));
                    });
                });
            }
        });
        // Load initial classes and sections if grade is selected
        if (current_grade_id) {
            loadClasses(current_grade_id).done(function(data) {
                var classSelect = $('select[name="class_id"]');
                classSelect.empty();
                $.each(data, function(key, value) {
                    classSelect.append($('<option>', {
                        value: key,
                        text: value
                    }));
                });
                classSelect.val(current_class_id); // Set current class

                loadSections(current_class_id).done(function(data) {
                    var sectionSelect = $('select[name="section_id"]');
                    sectionSelect.empty();
                    $.each(data, function(key, value) {
                        sectionSelect.append($('<option>', {
                            value: key,
                            text: value
                        }));
                    });
                    sectionSelect.val(current_section_id);

                });
            });
        }
    });
</script>



@endsection
