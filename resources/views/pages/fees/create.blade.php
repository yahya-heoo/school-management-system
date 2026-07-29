@extends('layouts.master')
@section('css')

@section('title')
    {{ trans('fees_trans.add_fee') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0" style="font-family: 'Cairo', sans-serif;"> {{ trans('fees_trans.add_fee') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active"> {{ trans('fees_trans.add_fee') }} </li>
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
                        <form action="{{ route('fees.store') }}" method="POST">
                            @csrf
                            <div class="form-row mb-2">
                                <div class="col">
                                    <label for="title">{{ trans('fees_trans.fee_type_ar') }}</label>
                                    <input type="text" name="fee_type_ar" class="form-control">
                                    @error('fee_type_ar')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="title">{{ trans('fees_trans.fee_type_en') }}</label>
                                    <input type="text" name="fee_type_en" class="form-control">
                                    @error('fee_type_en')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <hr>
                            <div class="form-row mb-2">


                                <div class="form-group col">
                                    <label for="title">{{ trans('fees_trans.amount') }}</label>
                                    <input type="number" name="amount" class="form-control">
                                    @error('amount')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col">

                                    <label for="title">{{ trans('students_trans.acdemic_year') }}</label>
                                    <select class="custom-select my-1 mr-sm-2" name="academic_year">
                                        <option selected disabled>{{ trans('students_trans.Choose') }}...</option>
                                        <option value="{{ date('Y') }}"> {{ date('Y') }} </option>
                                        <option value="{{ date('Y') + 1 }}"> {{ date('Y') + 1 }} </option>
                                    </select>
                                    @error('academic_year')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>


                            </div>


                            <div class="form-row">

                                <div class="form-group col">
                                    <label>{{ trans('students_trans.grade') }}</label>
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

                                <div class="form-group col">
                                    <label>{{ trans('students_trans.class') }}</label>
                                    <select class="custom-select my-1 mr-sm-2" name="class_id"
                                        onchange="console.log($(this).val())">

                                    </select>
                                    @error('class_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <hr>



                            <div class="form-group ">
                                <label for="exampleFormControlTextarea1">{{ trans('fees_trans.description') }}</label>
                                <textarea class="form-control" name='description' id="exampleFormControlTextarea1" rows="4"></textarea>
                                @error('description')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>



                            <button class="btn btn-success btn-sm nextBtn btn-lg pull-right"
                                type="submit">{{ trans('actions_trans.confirm') }}</button>

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
                    },
                });
            } else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>



@endsection
