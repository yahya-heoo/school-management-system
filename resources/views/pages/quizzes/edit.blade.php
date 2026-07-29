@extends('layouts.master')
@section('css')

@section('title')
{{trans('quizzes_trans.edit_quiz')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6" >
            <h4 class="mb-0" style="font-family: 'Cairo', sans-serif;" > {{trans('quizzes_trans.edit_quiz')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active"> {{trans('quizzes_trans.edit_quiz')}} </li>
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
                        <form action="{{ route('quizzes.update') }}" method="POST">
                            @csrf
                        <div class="form-row mb-2">
                            <div class="col">
                                <label for="title">{{ trans('quizzes_trans.title_ar') }}</label>
                                <input type="text" name="title_ar" class="form-control" value="{{$quiz->getTranslate('title','ar')}}">
                                @error('title_ar')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="title">{{ trans('quizzes_trans.title_en') }}</label>
                                <input type="text" name="title_en" class="form-control" value="{{$quiz->getTranslate('title','en')}}">
                                @error('title_en')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <hr>
                        <div class="form-row mb-2">
                            

                            <div class="form-group col">
                                <label for="subject_id">{{trans('subjects_trans.subject')}}</label>
                                <select class="custom-select my-1 mr-sm-2" name="subject_id">
                                        <option selected disabled>{{ trans('students_trans.choose') }}...</option>
                                        @foreach ($subjects as $subject)
                                            <option value="{{ $subject->id }}" {{ $subject->id == $quiz->subject_id ? 'selected':''}} >{{ $subject->name }}</option>
                                        @endforeach
                                    </select>
                                @error('subject_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col">
                                <label for="teacher_id">{{trans('teachers_trans.teacher_name')}}</label>
                                <select class="custom-select my-1 mr-sm-2" name="teacher_id">
                                        <option selected disabled>{{ trans('students_trans.choose') }}...</option>
                                        @foreach ($teachers as $teacher)
                                            <option value="{{ $teacher->id }}" {{ $teacher->id == $quiz->teacher_id ? 'selected':''}} >{{ $teacher->name }}</option>
                                        @endforeach
                                    </select>
                                @error('teacher_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            
                        </div>
                        

                        <div class="form-row">
                            
                            <div class="form-group col ">
                                <label for="inputState">{{ trans('students_trans.grade') }}</label>
                                <select class="custom-select my-1 mr-sm-2" name="grade_id"  onchange="console.log($(this).val())">
                                    <option selected>{{ trans('students_trans.choose') }}...</option>
                                    @foreach ($grades as $grade)
                                        <option value="{{ $grade->id }}" {{ $grade->id == $student->grade_id ? 'selected':'' }}>{{ $grade->name }}</option>
                                    @endforeach
                                </select>
                                @error('grade_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col ">
                                <label for="inputState">{{ trans('students_trans.class') }}</label>
                                <select class="custom-select my-1 mr-sm-2" name="class_id"  onchange="console.log($(this).val())">
                                
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
                        </div>

                        <hr>
                        
                        
                        
                        
                
                        
                
                        <button   class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit" 
                            >{{ trans('actions_trans.confirm') }}</button>
                
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
                        classSelect.append($('<option>', { value: key, text: value }));
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
                        sectionSelect.append($('<option>', { value: key, text: value }));
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
                    classSelect.append($('<option>', { value: key, text: value }));
                });
                classSelect.val(current_class_id); // Set current class
                
                // Load sections for the current class
                loadSections(current_class_id).done(function(sectionData) {
                    var sectionSelect = $('select[name="section_id"]');
                    sectionSelect.empty();
                    $.each(sectionData, function(key, value) {
                        sectionSelect.append($('<option>', { value: key, text: value }));
                    });
                    sectionSelect.val(current_section_id); // Set current section
                });
            });
        }
    });
</script>



@endsection

