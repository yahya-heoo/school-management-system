@extends('layouts.master')
@section('css')

@section('title')
    {{ trans('library_trans.add_resource') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0" style="font-family: 'Cairo', sans-serif;"> {{ trans('library_trans.add_resource') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active"> {{ trans('library_trans.add_resource') }} </li>
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
                        <form action="{{ route('library-resources.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-row mb-2">
                                <div class="col">
                                    <label for="title">{{ trans('library_trans.resource_title') }}</label>
                                    <input type="text" name="title" class="form-control">
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
                                            <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('grade_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col ">
                                    <label for="class_id" class="form-label">{{ trans('classrooms_trans.class') }}</label>
                                    <select class="form-control py-2 my-1 mr-sm-2" name="class_id"
                                        onchange="console.log($(this).val())">

                                    </select>
                                    @error('class_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col ">
                                    <label for="section_id" class="form-label">{{ trans('sections_trans.section') }}</label>
                                    <select class="form-control py-2 my-1 mr-sm-2" name="section_id">

                                    </select>
                                    @error('section_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                <label for="attachment" class="form-label">{{ trans('students_trans.attachments') }}</label>
                                <input type="file" name="attachment" class="form-control" >
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
