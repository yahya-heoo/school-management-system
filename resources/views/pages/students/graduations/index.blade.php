@extends('layouts.master')
@section('css')

@section('title')
    {{ trans('students_trans.graduations_list') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0" style="font-family: 'Cairo', sans-serif;"> {{ trans('students_trans.graduations_list') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active"> {{ trans('students_trans.graduations_list') }} </li>
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

                <a class="btn btn-success btn-sm btn-lg pull-right" href="{{ route('graduations.create') }}">
                {{ trans('students_trans.add_graduation') }} 
                </a>
                     <br>
                     <br>
                <div class="table-responsive">
                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                        style="text-align: center">
                        <thead>
                            <tr class="table-success">
                                <th>#</th>
                                <th>{{ trans('students_trans.student_name') }}</th>
                                <th>{{ trans('students_trans.grade') }}</th>
                                <th>{{ trans('students_trans.class') }}</th>
                                <th>{{ trans('students_trans.section') }}</th>
                                <th>{{ trans('students_trans.acdemic_year') }}</th>
                                <th>{{ trans('students_trans.processes') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach ($graduated_students as $student)
                                <tr>
                                    <?php $i++; ?>
                                    <td>{{ $i }}</td>
                                    <td>{{ $student->name }}</td>
                                    <td>{{$student->grades->name}}</td>
                                    <td>{{$student->classes->name}}</td>
                                    <td>{{$student->sections->name}}</td>
                                    <td>{{$student->academic_year}}</td>
                                    <td>
                                        {{-- <a href="{{ route('graduations.update', $student->id) }}"
                                            class="btn btn-primary btn-sm" title="{{ trans('students_trans.rollback') }}">
                                            {{ trans('students_trans.rollback') }}
                                            <i class="fa fa-edit"></i>
                                        </a> --}}
                                       
                                        <a href="#"
                                            class="btn btn-info btn-sm"
                                            data-toggle="modal"
                                            data-target="#graduate{{ $student->id }}"
                                            title="{{ trans('students_trans.rollback') }}">
                                            {{ trans('students_trans.rollback') }}
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="#"
                                            class="btn btn-danger btn-sm"
                                            data-toggle="modal"
                                            data-target="#delete{{ $student->id }}"
                                            title="{{ trans('students_trans.Delete') }}">
                                            {{ trans('students_trans.Delete') }}
                                            <i class="fa fa-trash"></i>
                                        </a>
                                        
                                        
                                    </td>
                                </tr>

                            {{-- delete modal --}}
                            <div class="modal fade" id="delete{{ $student->id }}" tabindex="-1" role="dialog" 
                                 aria-labelledby="exampleModalLabel"  aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                                                {{ trans('students_trans.delete_student') }}
                                            </h5>
                                            <button type="button"
                                                class="close"
                                                data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('graduations.destroy', $student->id ) }}" method="post">
                                                {{ method_field('Delete') }}
                                                @csrf
                                                {{ trans('students_trans.deleteQ') }}
                                                <br>
                                                <input id="id" type="hidden" name="id" class="form-control" value="{{ $student->id }}">
                                                <input  type="text" name="name" disabled class="form-control mt-1" value="{{ $student->name }}">
                                                <div class="modal-footer">
                                                    <button type="button"
                                                        class="btn btn-secondary"
                                                        data-dismiss="modal">{{ trans('students_trans.Close') }}</button>
                                                    <button type="submit"
                                                        class="btn btn-danger">{{ trans('students_trans.Delete') }}</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- rollback of graduate student --}}
                            <div class="modal fade" id="graduate{{ $student->id }}" tabindex="-1" role="dialog" 
                                 aria-labelledby="exampleModalLabel"  aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                                                {{ trans('students_trans.rollback') }}
                                            </h5>
                                            <button type="button"
                                                class="close"
                                                data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('graduations.update', $student->id) }}" method="post">
                                                {{ method_field('PATCH') }}
                                                @csrf
                                                {{ trans('students_trans.rollback_graduateQ') }} 
                                                <br>
                                                <input id="id" type="hidden" name="id" class="form-control" value="{{ $student->id }}">
                                                <input  type="text" name="name" disabled class="form-control mt-1 bg-info text-white" value="{{ $student->name }}">
                                                <div class="modal-footer">
                                                    <button type="button"
                                                        class="btn btn-secondary"
                                                        data-dismiss="modal">{{ trans('students_trans.Close') }}</button>
                                                    <button type="submit"
                                                        class="btn btn-info">{{ trans('students_trans.rollback') }}</button>
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
<!-- row closed -->
@endsection
@section('js')

@endsection
