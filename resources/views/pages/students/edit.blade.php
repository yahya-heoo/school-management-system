@extends('layouts.master')
@section('css')

@section('title')
    {{ trans('students_trans.edit_student') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0" style="font-family: 'Cairo', sans-serif;"> {{ trans('students_trans.edit_student') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active"> {{ trans('students_trans.edit_student') }} </li>
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

                        <form action="{{ route('students.update', $student->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="form-row  mb-2">
                                <h4 class="text-primary" style="font-family: 'Cairo', sans-serif;">
                                    {{ trans('students_trans.personal_information') }}</h4>
                            </div>
                            <input type="hidden" name="id" value="{{ $student->id }}">
                            <div class="form-row mb-2">
                                <div class="col">
                                    <label for="title">{{ trans('students_trans.student_name_ar') }}</label>
                                    <input type="text" name="student_name_ar" class="form-control"
                                        value="{{ $student->getTranslation('name', 'ar') }}" value="">
                                    @error('student_name_ar')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="title">{{ trans('students_trans.student_name_en') }}</label>
                                    <input type="text" name="student_name_en" class="form-control"
                                        value="{{ $student->getTranslation('name', 'en') }}">
                                    @error('student_name_en')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-row mb-2">


                                <div class="form-group col">
                                    <label for="title">{{ trans('students_trans.email') }}</label>
                                    <input type="email" name="email" class="form-control"
                                        value="{{ $student->email }}">
                                    @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col">
                                    <label for="title">{{ trans('students_trans.password') }}</label>
                                    <input type="password" name="password" class="form-control">
                                    @error('password')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>


                            </div>


                            <div class="form-row">

                                <div class="form-group col">
                                    <label for="inputState">{{ trans('students_trans.student_gender') }}</label>
                                    <select class="custom-select my-1 mr-sm-2" name="gender_id">
                                        <option selected>{{ trans('students_trans.choose') }}...</option>
                                        @foreach ($genders as $gender)
                                            <option value="{{ $gender->id }}"
                                                {{ $gender->id == $student->gender_id ? 'selected' : '' }}>
                                                {{ $gender->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('gender_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col">
                                    <label for="inputZip">{{ trans('students_trans.student_nationality') }}</label>
                                    <select class="custom-select my-1 mr-sm-2" name="nationality_id">
                                        <option selected>{{ trans('students_trans.choose') }}...</option>
                                        @foreach ($nationalities as $nationality)
                                            <option value="{{ $nationality->id }}"
                                                {{ $nationality->id == $student->nationality_id ? 'selected' : '' }}>
                                                {{ $nationality->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('nationality_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col">
                                    <label for="inputState">{{ trans('students_trans.Blood_Type') }}</label>
                                    <select class="custom-select my-1 mr-sm-2" name="blood_type_id">
                                        <option selected>{{ trans('students_trans.Choose') }}...</option>
                                        @foreach ($blood_types as $blood_type)
                                            <option value="{{ $blood_type->id }}"
                                                {{ $blood_type->id == $student->blood_type_id ? 'selected' : '' }}>
                                                {{ $blood_type->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('blood_type_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col">
                                    <div class="form-group ">
                                        <label for="title">{{ trans('students_trans.birth_date') }}</label>
                                        <input type="date" name="birth_date" value="{{ $student->birth_date }}"
                                            class="form-control">
                                        @error('birth_date')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="form-row  mb-2">
                                <h4 class="text-primary" style="font-family: 'Cairo', sans-serif;">
                                    {{ trans('students_trans.student_information') }}</h4>
                            </div>
                            <div class="form-group ">
                                <div class="form-row">
                                    <div class="form-group col ">
                                        <label for="inputState">{{ trans('students_trans.grade') }}</label>
                                        <select class="custom-select my-1 mr-sm-2" name="grade_id"
                                            onchange="console.log($(this).val())">
                                            <option selected>{{ trans('students_trans.choose') }}...</option>
                                            @foreach ($grades as $grade)
                                                <option value="{{ $grade->id }}"
                                                    {{ $grade->id == $student->grade_id ? 'selected' : '' }}>
                                                    {{ $grade->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('grade_id')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col ">
                                        <label for="inputState">{{ trans('students_trans.class') }}</label>
                                        <select class="custom-select my-1 mr-sm-2" name="class_id"
                                            onchange="console.log($(this).val())">

                                        </select>
                                        @error('class_id')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col ">
                                        <label for="inputZip">{{ trans('students_trans.section') }}</label>
                                        <select class="custom-select my-1 mr-sm-2" name="section_id">

                                        </select>
                                        @error('section_id')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col ">
                                        <label for="inputState">{{ trans('students_trans.parent') }}</label>
                                        <select class="custom-select my-1 mr-sm-2" name="parent_id">
                                            <option selected>{{ trans('students_trans.Choose') }}...</option>
                                            @foreach ($parents as $parent)
                                                <option value="{{ $parent->id }}"
                                                    {{ $parent->id == $student->parent_id ? 'selected' : '' }}>
                                                    {{ $parent->father_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('parent_id')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col">
                                        <div class="form-group ">
                                            <label for="title">{{ trans('students_trans.acdemic_year') }}</label>
                                            <select class="custom-select my-1 mr-sm-2" name="academic_year">

                                                <option value="{{ date('Y') }}"
                                                    {{ $student->academic_year == date('Y') ? 'selected' : '' }}>
                                                    {{ date('Y') }} </option>
                                                <option value="{{ date('Y') + 1 }}"
                                                    {{ $student->academic_year == date('Y') + 1 ? 'selected' : '' }}>
                                                    {{ date('Y') + 1 }} </option>
                                            </select>
                                            @error('academic_year')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <button class="btn btn-success btn-sm nextBtn btn-lg pull-right"
                                type="submit">{{ trans('students_trans.Next') }}</button>

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
        var current_grade_id = {{ $student->grade_id }};
        var current_class_id = {{ $student->class_id }};
        var current_section_id = {{ $student->section_id }};

        // Function to load classes via AJAX
        function loadClasses(gradeId) {
            return $.ajax({
                url: "{{ URL::to('getStudentClasses') }}/" + gradeId,
                type: "GET",
                dataType: "json"
            });
        }

        // Function to load sections via AJAX
        function loadSections(classId) {
            return $.ajax({
                url: "{{ URL::to('getStudentSections') }}/" + classId,
                type: "GET",
                dataType: "json"
            });
        }

        // Handle grade change event
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
                    classSelect.trigger('change'); // Trigger change to load sections
                });
            } else {
                $('select[name="class_id"], select[name="section_id"]').empty();
            }
        });

        // Handle class change event
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
            } else {
                $('select[name="section_id"]').empty();
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

                // Load sections for the current class
                loadSections(current_class_id).done(function(sectionData) {
                    var sectionSelect = $('select[name="section_id"]');
                    sectionSelect.empty();
                    $.each(sectionData, function(key, value) {
                        sectionSelect.append($('<option>', {
                            value: key,
                            text: value
                        }));
                    });
                    sectionSelect.val(current_section_id); // Set current section
                });
            });
        }
    });
</script>
@endsection
