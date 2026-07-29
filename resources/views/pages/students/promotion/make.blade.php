@extends('layouts.master')
@section('css')

@section('title')
{{trans('students_trans.promotion')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6" >
            <h4 class="mb-0" style="font-family: 'Cairo', sans-serif;" > {{trans('students_trans.promotion')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active"> {{trans('students_trans.promotion')}} </li>
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
                        <center>
                            @if ($errors->any())
                            
                                <div class="alert alert-danger">
                                    <ul style="list-style: none">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            
                            @endif
                        </center>
                        <form action="{{ route('promotions.store') }}" method="POST">
                            @csrf
                           
                        <div class="form-row  mb-2">
                            <h4 class="text-primary" style="font-family: 'Cairo', sans-serif;">{{trans('students_trans.current_stage')}}</h4>
                        </div>
                        <div class="form-group ">
                            <div class="form-row">
                                <div class="form-group col ">
                                    <label >{{ trans('students_trans.grade') }}</label>
                                    <select class="custom-select my-1 mr-sm-2" name="grade_id"  onchange="console.log($(this).val())">
                                        <option selected>{{ trans('students_trans.choose') }}...</option>
                                        @foreach ($grades as $grade)
                                            <option value="{{ $grade->id }}" >{{ $grade->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('grade_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col ">
                                    <label >{{ trans('students_trans.class') }}</label>
                                    <select class="custom-select my-1 mr-sm-2" name="class_id"  onchange="console.log($(this).val())">
                                    
                                    </select>
                                    @error('class_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col ">
                                    <label >{{ trans('students_trans.section') }}</label>
                                    <select class="custom-select my-1 mr-sm-2" name="section_id">
                                    
                                    </select>
                                    @error('section_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col ">
                                        <label >{{ trans('students_trans.acdemic_year') }}</label>
                                        <select class="custom-select my-1 mr-sm-2" name="academic_year">
                                            <option disabled selected>{{trans('students_trans.Choose')}}...</option>
                                            <option value="{{date('Y')}}"> {{date('Y')}} </option>
                                            <option value="{{date('Y')+1}}"> {{date('Y')+1}} </option>
                                        </select>
                                        @error('academic_year')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                </div>
                                
                                
                            </div>
                        </div>

                        <div class="form-row  mb-2">
                            <h4 class="text-primary" style="font-family: 'Cairo', sans-serif;">{{trans('students_trans.next_stage')}}</h4>
                        </div>
                        <div class="form-group ">
                            <div class="form-row">
                                <div class="form-group col ">
                                    <label for="inputState">{{ trans('students_trans.grade') }}</label>
                                    <select class="custom-select my-1 mr-sm-2" name="next_grade_id"  onchange="console.log($(this).val())">
                                        <option selected>{{ trans('students_trans.choose') }}...</option>
                                        @foreach ($grades as $grade)
            
                                            <option value="{{ $grade->id }}" >{{ $grade->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('next_grade_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col ">
                                    <label for="inputState">{{ trans('students_trans.class') }}</label>
                                    <select class="custom-select my-1 mr-sm-2" name="next_class_id"  onchange="console.log($(this).val())">
                                    
                                    </select>
                                    @error('next_class_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col ">
                                    <label for="inputZip">{{ trans('students_trans.section') }}</label>
                                    <select class="custom-select my-1 mr-sm-2" name="next_section_id">
                                    
                                    </select>
                                    @error('next_section_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col ">
                                    <label >{{ trans('students_trans.acdemic_year') }}</label>
                                    <select class="custom-select my-1 mr-sm-2" name="next_academic_year">
                                        <option disabled selected>{{trans('students_trans.Choose')}}...</option>
                                        <option value="{{date('Y')}}"> {{date('Y')}} </option>
                                        <option value="{{date('Y')+1}}"> {{date('Y')+1}} </option>
                                    </select>
                                    @error('next_academic_year')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                
                            </div>
                        </div>
                
                        <button   class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit" 
                            >{{ trans('students_trans.Next') }}</button>
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
<script>
    $(document).ready(function() {
        $('select[name="next_grade_id"]').on('change', function() {
            var Grade_id = $(this).val();
            if (Grade_id) {
                $.ajax({
                    url: "{{ URL::to('getStudentClasses') }}/" + Grade_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="next_class_id"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="next_class_id"]').append(
                                '<option value="' + key + '">' + value + '</option>'
                            );
                        });
                        // Trigger change event to load sections immediately
                        $('select[name="next_class_id"]').trigger('change');
                    },
                });
            } else {
                console.log('AJAX load did not work');
            }
        });
    
        
        $(document).on('change', 'select[name="next_class_id"]', function() {
            var Class_id = $(this).val();
            if (Class_id) {
                $.ajax({
                    url: "{{ URL::to('getStudentSections') }}/" + Class_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="next_section_id"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="next_section_id"]').append(
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




