@extends('layouts.master')
@section('css')

@section('title')
{{trans('subjects_trans.edit_subject')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6" >
            <h4 class="mb-0" style="font-family: 'Cairo', sans-serif;" > {{trans('subjects_trans.edit_subject')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active"> {{trans('subjects_trans.edit_subject')}} </li>
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
                        <form action="{{ route('subjects.update','test') }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="id"  value="{{$subject->id}}">
                        <div class="form-row mb-2">
                            <div class="form-group col">
                                <label >{{ trans('subjects_trans.subject_name') }}</label>
                                    <select class="custom-select my-1 mr-sm-2" name="specialization_id" >
                                        <option selected disabled>{{ trans('students_trans.choose') }}...</option>
                                        @foreach ($specializations as $specialization)
                                            <option value="{{ $specialization->id }}" {{$specialization->id == $subject->specialization_id ? 'selected' :'' }} >{{ $specialization->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('specialization_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                            </div>
                         
                            <div class="form-group col">
                                <label class="control-label">{{ trans('sections_trans.section_teacher') }}</label>
                                <select name="teacher_id" class="custom-select my-1 mr-sm-2" >
                                    @foreach ($teachers as $teacher)
                                        <option class="m-0" value="{{ $teacher->id }}" {{ $subject->teachers->contains('id', $teacher->id) ? 'selected' : '' }}>
                                             {{ $teacher->name }} | {{$teacher->specializations->name}}
                                        </option>
                                        <hr class="m-0 mb-1" >
                                    @endforeach
                                </select>
                                @error('teacher_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            
                        </div>

                        <hr>
                        
                        

                        <div class="form-row">
                            
                            <div class="form-group col">
                                <label >{{ trans('students_trans.grade') }}</label>
                                    <select class="custom-select my-1 mr-sm-2" name="grade_id"  onchange="console.log($(this).val())">
                                        <option disabled>{{ trans('students_trans.choose') }}...</option>
                                        @foreach ($grades as $grade)
                                            <option value="{{ $grade->id }}" {{$subject->grade_id == $grade->id ? 'selected' : ''}}>{{ $grade->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('grade_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                            </div>

                            <div class="form-group col">
                                <label >{{ trans('students_trans.class') }}</label>
                                <select class="custom-select my-1 mr-sm-2" name="class_id"  onchange="console.log($(this).val())">
                                
                                </select>
                                @error('class_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            
                        </div>

                        <hr>
                        
                        
                        
                        
                        
                
                        <button   class="btn btn-info btn-sm nextBtn btn-lg pull-right" type="submit" 
                            >{{ trans('actions_trans.edit') }}</button>
                
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
        var current_grade_id = {{ $subject->grade_id }};
        var current_class_id = {{ $subject->class_id }};
        

        // Function to load classes via AJAX
        function loadClasses(gradeId) {
            return $.ajax({
                url: "{{ URL::to('getStudentClasses') }}/" + gradeId,
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
                        classSelect.append($('<option>', { value: key, text: value }));
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
                    classSelect.append($('<option>', { value: key, text: value }));
                });
                classSelect.val(current_class_id); // Set current class
                
            });
        }
    });


</script>



@endsection

