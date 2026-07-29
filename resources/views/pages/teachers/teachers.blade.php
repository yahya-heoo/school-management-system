@extends('layouts.master')
@section('css')

@section('title')
    {{ trans('teachers_trans.teachers_list') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0" style="font-family: 'Cairo', sans-serif;"> {{ trans('teachers_trans.teachers_list') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active"> {{ trans('teachers_trans.teachers_list') }} </li>
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

                <a class="btn btn-success btn-sm btn-lg pull-right" href="{{ route('teachers.create') }}">
                {{ trans('teachers_trans.add_teacher') }} 
                </a>
                     <br>
                     <br>
                <div class="table-responsive">
                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                        style="text-align: center">
                        <thead>
                            <tr class="table-success">
                                <th>#</th>
                                <th>{{ trans('teachers_trans.teacher_name') }}</th>
                                <th>{{ trans('teachers_trans.teacher_gender') }}</th>
                                <th>{{ trans('teachers_trans.teacher_specialization') }}</th>
                                <th>{{ trans('teachers_trans.joining_date') }}</th>
                                <th>{{ trans('teachers_trans.processes') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach ($teachers as $teacher)
                                <tr>
                                    <?php $i++; ?>
                                    <td>{{ $i }}</td>
                                    <td>{{ $teacher->name }}</td>
                                    <td>{{ $teacher->genders->name }}</td>
                                    <td>{{ $teacher->specializations->name }}</td>
                                    <td>{{ $teacher->joining_date }}</td>
                                    <td>
                                        <a href="{{ route('teachers.edit', $teacher->id) }}"
                                            class="btn btn-primary btn-sm" title="{{ trans('grades_trans.edit') }}">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                       
                                        <a href="#"
                                            class="btn btn-danger btn-sm"
                                            data-toggle="modal"
                                            data-target="#delete{{ $teacher->id }}"
                                            title="{{ trans('grades_trans.delete') }}">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                        
                                    </td>
                                </tr>

                            <div class="modal fade" id="delete{{ $teacher->id }}" tabindex="-1" role="dialog" 
                                 aria-labelledby="exampleModalLabel"  aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;"
                                                class="modal-title"
                                                id="exampleModalLabel">
                                                {{ trans('teachers_trans.delete_teacher') }}
                                            </h5>
                                            <button type="button"
                                                class="close"
                                                data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('teachers.destroy', 'test') }}" method="post">
                                                {{ method_field('Delete') }}
                                                @csrf
                                                {{ trans('teachers_trans.deleteQ') }}
                                                <br>
                                                <input id="id" type="hidden" name="id" class="form-control" value="{{ $teacher->id }}">
                                                <div class="modal-footer">
                                                    <button type="button"
                                                        class="btn btn-secondary"
                                                        data-dismiss="modal">{{ trans('teachers_trans.Close') }}</button>
                                                    <button type="submit"
                                                        class="btn btn-danger">{{ trans('teachers_trans.Delete') }}</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
