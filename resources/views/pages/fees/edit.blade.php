@extends('layouts.master')
@section('css')

@section('title')
{{trans('fees_trans.edit_fee')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6" >
            <h4 class="mb-0" style="font-family: 'Cairo', sans-serif;" > {{trans('fees_trans.edit_fee')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active"> {{trans('fees_trans.edit_fee')}} </li>
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
                        <form action="{{ route('fees.update',$fee->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="id"  value="{{$fee->id}}">
                        <div class="form-row mb-2">
                            <div class="col">
                                <label for="title">{{ trans('fees_trans.fee_type_ar') }}</label>
                                <input type="text" name="fee_type_ar" class="form-control"  value="{{$fee->getTranslation('fee_type','ar')}}">
                                @error('fee_type_ar')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="title">{{ trans('fees_trans.fee_type_en') }}</label>
                                <input type="text" name="fee_type_en" class="form-control"  value="{{$fee->getTranslation('fee_type','en')}}">
                                @error('fee_type_en')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <hr>
                        <div class="form-row mb-2">
                            

                            <div class="form-group col">
                                <label for="title">{{trans('fees_trans.amount')}}</label>
                                <input type="number" name="amount"  class="form-control" value="{{$fee->fee_amount}}">
                                @error('amount')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col">
                               
                                <label for="title">{{ trans('students_trans.acdemic_year') }}</label>
                                        <select class="custom-select my-1 mr-sm-2" name="academic_year">
                                          
                                            <option value="{{date('Y')}}" {{$fee->academic_year==date('Y')?'selected':''}}> {{date('Y')}} </option>
                                            <option value="{{date('Y')+1}}" {{$fee->academic_year==date('Y')+1?'selected':''}}> {{date('Y')+1}} </option>
                                        </select>
                                        @error('academic_year')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                            </div>

                            
                        </div>
                        

                        <div class="form-row">
                            
                            <div class="form-group col">
                                <label >{{ trans('students_trans.grade') }}</label>
                                    <select class="custom-select my-1 mr-sm-2" name="grade_id"  onchange="console.log($(this).val())">
                                        <option selected disabled>{{ trans('students_trans.choose') }}...</option>
                                        @foreach ($grades as $grade)
                                        <option value="{{ $grade->id }}" {{ $grade->id == $fee->grade_id ? 'selected':'' }}>{{ $grade->name }}</option>
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
                        
                        
                        
                        <div class="form-group ">
                            <label for="exampleFormControlTextarea1">{{ trans('fees_trans.description') }}</label>
                            <textarea class="form-control" name='description' id="exampleFormControlTextarea1" rows="4">
                                {{$fee->fee_description}}
                            </textarea>
                            @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                
                        
                
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
        var current_grade_id = {{ $fee->grade_id }};
        var current_class_id = {{ $fee->class_id }};
        

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

