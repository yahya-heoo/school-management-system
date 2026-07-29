@extends('layouts.master')
@section('css')

@section('title')
    {{ trans('students_trans.promotion') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0" style="font-family: 'Cairo', sans-serif;"> {{ trans('students_trans.promotion') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active"> {{ trans('students_trans.promotion') }} </li>
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

                <a href="" class="btn btn-danger btn-md mt-1" data-toggle="modal" data-target="#rollback"
                    title="{{ trans('students_trans.rollback_all') }}">
                    {{ trans('students_trans.rollback_all') }}
                </a>
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
                        <div class="table-responsive">
                            <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                data-page-length="50" style="text-align: center">
                                <thead>
                                    <tr class="table-success">
                                        <!-- Main headers -->
                                        <th rowspan="2" class="text-center align-middle p-3 w-5">#</th>
                                        <th rowspan="2" class="text-center align-middle p-3 w-10">
                                            {{ trans('students_trans.student_name') }}</th>
                                        <th colspan="4" class="text-center p-3 w-30">
                                            {{ trans('students_trans.previous_state') }}</th>
                                        <th colspan="4" class="text-center p-3 w-30">
                                            {{ trans('students_trans.next_state') }}</th>
                                        <th rowspan="2" class="text-center align-middle p-3 w-15">
                                            {{ trans('students_trans.processes') }}</th>
                                    </tr>
                                    <tr class="table-success">
                                        <!-- Previous State Sub-headers -->
                                        <th class="text-center p-2">{{ trans('students_trans.grade') }}</th>
                                        <th class="text-center p-2">{{ trans('students_trans.class') }}</th>
                                        <th class="text-center p-2">{{ trans('students_trans.section') }}</th>
                                        <th class="text-center p-2 ">{{ trans('students_trans.acdemic_year') }}</th>

                                        <!-- Next State Sub-headers -->
                                        <th class="text-center p-2">{{ trans('students_trans.grade') }}</th>
                                        <th class="text-center p-2">{{ trans('students_trans.class') }}</th>
                                        <th class="text-center p-2">{{ trans('students_trans.section') }}</th>
                                        <th class="text-center p-2 ">{{ trans('students_trans.acdemic_year') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0; ?>
                                    @foreach ($promotions as $promotion)
                                        <tr>
                                            <?php $i++; ?>
                                            <td>{{ $i }}</td>
                                            <td>{{ $promotion->students->name }}</td>

                                            <td>{{ $promotion->from_grades->name }}</td>
                                            <td>{{ $promotion->from_classes->name }}</td>
                                            <td>{{ $promotion->from_sections->name }}</td>
                                            <td>{{ $promotion->from_academic_year }}</td>
                                            <td>{{ $promotion->to_grades->name }}</td>
                                            <td>{{ $promotion->to_classes->name }}</td>
                                            <td>{{ $promotion->to_sections->name }}</td>
                                            <td>{{ $promotion->to_academic_year }}</td>
                                            <td class="d-flex gap-2 justify-content-center mt-1">



                                                <a href="#" class="btn btn-danger btn-sm mt-1" data-toggle="modal"
                                                    data-target="#delete{{ $promotion->id }}"
                                                    title="{{ trans('students_trans.rollback') }}">
                                                    {{ trans('students_trans.rollback') }}

                                                </a>
                                                <a href="#"  class="btn btn-info  btn-sm mt-1" data-toggle="modal"
                                                    data-target="#graduate{{ $promotion->id }}"
                                                    title="{{ trans('students_trans.graduate') }}">
                                                    {{ trans('students_trans.graduate') }}
                                                </a>
                                                

                                            </td>
                                        </tr>

                                        {{-- rollback one student promotion modal --}}
                                        <div class="modal fade" id="delete{{ $promotion->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 style="font-family: 'Cairo', sans-serif;"
                                                            class="modal-title" id="exampleModalLabel">
                                                            {{ trans('students_trans.rollback') }}
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('promotions.destroy', $promotion->id) }}"
                                                            method="post">
                                                            {{ method_field('Delete') }}
                                                            @csrf
                                                            {{ trans('students_trans.rollbackQ') }}
                                                            <br>
                                                            <input id="id" type="hidden" name="id"
                                                                class="form-control" value="{{ $promotion->id }}">
                                                            
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">{{ trans('students_trans.Close') }}</button>
                                                                <button type="submit"
                                                                    class="btn btn-danger">{{ trans('students_trans.rollback') }}</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- graduate --}}
                                        <div class="modal fade" id="graduate{{ $promotion->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 style="font-family: 'Cairo', sans-serif;"
                                                            class="modal-title" id="exampleModalLabel">
                                                            {{ trans('students_trans.graduate') }}
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('graduations.store') }}"
                                                            method="post">
                                                            
                                                            @csrf
                                                            {{ trans('students_trans.graduateQ') }}

                                                            <br>
                                                            <input id="id" type="hidden" name="id"
                                                                class="form-control" value="{{ $promotion->id }}">
                                                            <input id="id" type="text" name="id"
                                                                class="form-control bg-info mt-1 text-white" disabled value="{{ $promotion->students->name}}">
                                                            
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">{{ trans('students_trans.Close') }}</button>
                                                                <button type="submit"
                                                                    class="btn btn-info">{{ trans('students_trans.graduate') }}</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- rollback all of students --}}
                                        <div class="modal fade" id="rollback" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 style="font-family: 'Cairo', sans-serif;"
                                                            class="modal-title" id="exampleModalLabel">
                                                            {{ trans('students_trans.rollback_all') }}
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('promotions.destroy', 'test') }}"
                                                            method="post">
                                                            {{ method_field('Delete') }}
                                                            @csrf
                                                            {{ trans('students_trans.rollback_all_Q') }}
                                                            <br>
                                                            <input type="hidden" name="rollback_type" value="1">
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">{{ trans('students_trans.Close') }}</button>
                                                                <button type="submit"
                                                                    class="btn btn-danger">{{ trans('students_trans.rollback') }}</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

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
                                '<option value="' + key + '">' + value +
                                '</option>'
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
