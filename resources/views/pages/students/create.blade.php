@extends('layouts.master')
@section('css')

@section('title')
    {{ trans('students_trans.add_student') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0" style="font-family: 'Cairo', sans-serif;"> {{ trans('students_trans.add_student') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active"> {{ trans('students_trans.add_student') }} </li>
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

                        <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-row  mb-2">
                                <h4 class="text-primary" style="font-family: 'Cairo', sans-serif;">
                                    {{ trans('students_trans.personal_information') }}</h4>
                            </div>
                            <div class="form-row mb-2">
                                <div class="col">
                                    <label for="title">{{ trans('students_trans.student_name_ar') }}</label>
                                    <input type="text" name="student_name_ar" class="form-control">
                                    @error('student_name_ar')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="title">{{ trans('students_trans.student_name_en') }}</label>
                                    <input type="text" name="student_name_en" class="form-control">
                                    @error('student_name_en')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-row mb-2">


                                <div class="form-group col">
                                    <label for="title">{{ trans('students_trans.email') }}</label>
                                    <input type="email" name="email" class="form-control">
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
                                            <option value="{{ $gender->id }}">{{ $gender->name }}</option>
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
                                            <option value="{{ $nationality->id }}">{{ $nationality->name }}</option>
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
                                            <option value="{{ $blood_type->id }}">{{ $blood_type->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('blood_type_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col">
                                    <div class="form-group ">
                                        <label for="title">{{ trans('students_trans.birth_date') }}</label>
                                        <input type="date" name="birth_date" class="form-control">
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
                            <div class="form-group mb-0">
                                <div class="form-row">
                                    <div class="form-group col ">
                                        <label for="inputState">{{ trans('students_trans.grade') }}</label>
                                        <select class="custom-select my-1 mr-sm-2" name="grade_id"
                                            onchange="console.log($(this).val())">
                                            <option selected disabled>{{ trans('students_trans.choose') }}...</option>
                                            @foreach ($grades as $grade)
                                                <option value="{{ $grade->id }}">{{ $grade->name }}</option>
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
                                                <option value="{{ $parent->id }}">{{ $parent->father_name }}
                                                </option>
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
                                                <option selected>{{ trans('students_trans.Choose') }}...</option>
                                                <option value="{{ date('Y') }}"> {{ date('Y') }} </option>
                                                <option value="{{ date('Y') + 1 }}"> {{ date('Y') + 1 }} </option>
                                            </select>
                                            @error('academic_year')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>



                                </div>
                            </div>
                            <div class="mt-0 mb-2">
                                <label for="title"
                                    class="">{{ trans('students_trans.attachments') }}</label>
                                <br>
                                <input type="file" name="photos[]" accept="image/*" multiple>
                            </div>
                            <br>



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
