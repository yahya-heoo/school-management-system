@extends('layouts.master')
@section('css')

@section('title')
    {{ trans('students_trans.students_list') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0" style="font-family: 'Cairo', sans-serif;"> {{ trans('students_trans.students_list') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active"> {{ trans('students_trans.students_list') }} </li>
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

                <a class="btn btn-success btn-sm btn-lg pull-right" href="{{ route('students.create') }}">
                    {{ trans('students_trans.add_student') }}
                </a>
                <br>
                <br>
                <div class="table-responsive">
                    <table class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                        style="text-align: center">
                        <thead>
                            <tr class="table-success">
                                <th>#</th>
                                <th>{{ trans('students_trans.student_name') }}</th>
                                <th>{{ trans('students_trans.student_gender') }}</th>
                                <th>{{ trans('students_trans.grade') }}</th>
                                <th>{{ trans('students_trans.class') }}</th>
                                <th>{{ trans('students_trans.section') }}</th>
                                <th>{{ trans('students_trans.acdemic_year') }}</th>
                                <th>{{ trans('students_trans.processes') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach ($students as $student)
                                <tr>
                                    <?php $i++; ?>
                                    <td>{{ $i }}</td>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->gender->name }}</td>
                                    <td>{{ $student->grade->name }}</td>
                                    <td>{{ $student->class->name }}</td>
                                    <td>{{ $student->section->name }}</td>
                                    <td>{{ $student->academic_year }}</td>
                                    <td>
                                        <div class="dropdown show">
                                            <a class="btn btn-success dropdown-toggle" href="#" role="button"
                                                id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                {{ trans('students_trans.processes') }}
                                            </a>

                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a href="{{ route('students.edit', $student->id) }}"
                                                    class="dropdown-item" title="{{ trans('grades_trans.edit') }}">
                                                    <i style="color: rgb(0, 102, 255)" class="fa fa-edit"></i>
                                                    {{ trans('grades_trans.edit') }}
                                                </a>

                                                <a href="{{ route('students.show', $student->id) }}"
                                                    class="dropdown-item"
                                                    title="{{ trans('students_trans.preview') }}">
                                                    <i style="color: #55a605" class="fa fa-eye"></i>
                                                    {{ trans('students_trans.preview') }}
                                                </a>
                                                <a href="{{ route('invoices.show', $student->id) }}"
                                                    class="dropdown-item"
                                                    title="{{ trans('invoices_trans.add_invoice') }}">
                                                    <i style="color: rgb(220, 201, 0)" class="fa fa-file"></i>
                                                    {{ trans('invoices_trans.add_invoice') }}
                                                </a>
                                                <a href="{{ route('receipts.show', $student->id) }}"
                                                    class="dropdown-item"
                                                    title="{{ trans('receipts_trans.add_receipt') }}">
                                                    <i style="color:#fe7d03" class="fa fa-file"></i>
                                                    {{ trans('receipts_trans.add_receipt') }}
                                                </a>
                                                <a href="{{ route('refunds.show', $student->id) }}"
                                                    class="dropdown-item"
                                                    title="{{ trans('refunds_trans.add_refund') }}">
                                                    <i style="color:#9d5d1d" class="fa fa-file"></i>
                                                    {{ trans('refunds_trans.add_refund') }}
                                                </a>
                                                <a href="#" class="dropdown-item" data-toggle="modal"
                                                    data-target="#delete{{ $student->id }}"
                                                    title="{{ trans('grades_trans.delete') }}">
                                                    <i style="color: rgb(255, 0, 0)" class="fa fa-trash"></i>
                                                    {{ trans('grades_trans.delete') }}
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                {{-- delete modal --}}
                                <div class="modal fade" id="delete{{ $student->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                    id="exampleModalLabel">
                                                    {{ trans('students_trans.delete_student') }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('students.destroy', $student->id) }}"
                                                    method="post">
                                                    {{ method_field('Delete') }}
                                                    @csrf
                                                    {{ trans('students_trans.deleteQ') }}
                                                    <br>
                                                    <input id="id" type="hidden" name="id"
                                                        class="form-control" value="{{ $student->id }}">
                                                    <input type="text" name="name" disabled
                                                        class="form-control mt-1" value="{{ $student->name }}">
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">{{ trans('students_trans.Close') }}</button>
                                                        <button type="submit"
                                                            class="btn btn-danger">{{ trans('students_trans.Delete') }}</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $students->links() }}
                </div>

            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
