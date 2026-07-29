@extends('layouts.master')
@section('css')

@section('title')
{{trans('quizzes_trans.add_quiz')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6" >
            <h4 class="mb-0" style="font-family: 'Cairo', sans-serif;" > {{trans('quizzes_trans.add_quiz')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active"> {{trans('quizzes_trans.add_quiz')}} </li>
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
                        <form action="{{ route('quizzes.store') }}" method="POST">
                            @csrf
                        <div class="form-row mb-2">
                            <div class="col">
                                <label for="title">{{ trans('quizzes_trans.title_ar') }}</label>
                                <input type="text" name="title_ar" class="form-control">
                                @error('title_ar')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="title">{{ trans('quizzes_trans.title_en') }}</label>
                                <input type="text" name="title_en" class="form-control">
                                @error('title_en')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <hr>
                        <div class="form-row mb-2">
                            

                            <div class="form-group col">
                                <label for="subject_id">{{trans('subjects_trans.subject_name')}}</label>
                                <select class="custom-select my-1 mr-sm-2" name="subject_id">
                                        <option selected disabled>{{ trans('students_trans.choose') }}...</option>
                                        @foreach ($subjects as $subject)
                                            <option value="{{ $subject->id }}" >{{ $subject->specializations->name }}</option>
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
                                            <option value="{{ $teacher->id }}" >{{ $teacher->name }}</option>
                                        @endforeach
                                    </select>
                                @error('teacher_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            
                        </div>
                        

                        <div class="form-row">
                            
                            <div class="form-group col ">
                                <label for="inputState">{{ trans('quizzes_trans.grade') }}</label>
                                <select class="custom-select my-1 mr-sm-2" name="grade_id"  onchange="console.log($(this).val())">
                                    <option selected>{{ trans('students_trans.choose') }}...</option>
                                    @foreach ($grades as $grade)
                                        <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                    @endforeach
                                </select>
                                @error('grade_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col ">
                                <label for="inputState">{{ trans('quizzes_trans.class') }}</label>
                                <select class="custom-select my-1 mr-sm-2" name="class_id"  onchange="console.log($(this).val())">
                                
                                </select>
                                @error('class_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col ">
                                <label for="inputZip">{{ trans('quizzes_trans.section') }}</label>
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
                            '<option value="' + key + '">' + value + '</option>'
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
                            '<option value="' + key + '">' + value + '</option>'
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

