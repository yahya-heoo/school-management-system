@extends('layouts.master')
@section('css')

@section('title')
    {{ trans('invoices_trans.invoices') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0" style="font-family: 'Cairo', sans-serif;"> {{ trans('invoices_trans.invoices') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active"> {{ trans('invoices_trans.invoices') }} </li>
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

                {{-- <a class="btn btn-success btn-sm btn-lg pull-right" href="{{ route('invoices.create') }}">
                {{ trans('invoices_trans.add_invoice') }} 
                </a> --}}

                <div class="table-responsive">
                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                        style="text-align: center">
                        <thead>
                            <tr class="table-warning">
                                <th>#</th>
                                <th>{{ trans('students_trans.student_name') }}</th>
                                <th>{{ trans('invoices_trans.type') }}</th>
                                <th>{{ trans('invoices_trans.amount') }}</th>
                                <th>{{ trans('students_trans.grade') }}</th>
                                <th>{{ trans('students_trans.class') }}</th>
                                <th>{{ trans('invoices_trans.description') }}</th>
                                <th>{{ trans('students_trans.processes') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach ($invoices as $invoice)
                                <tr>
                                    <?php $i++; ?>
                                    <td>{{ $i }}</td>
                                    <td>{{$invoice->students->name}}</td>
                                    <td>{{$invoice->fees->fee_type}}</td>
                                    <td>{{$invoice->invoice_amount}}</td>
                                    <td>{{$invoice->grades->name}}</td>
                                    <td>{{$invoice->classes->name}}</td>
                                    <td>{{$invoice->invoice_description}}</td>
                                    <td>
                                        <a href="{{ route('invoices.edit', $invoice->id) }}"
                                            class="btn btn-primary btn-sm" title="{{ trans('actions_trans.edit') }}">
                                            {{ trans('actions_trans.edit') }}
                                            <i class="fa fa-edit"></i>
                                        </a>
                                       
                                    
                                        <a href="#"
                                            class="btn btn-danger btn-sm"
                                            data-toggle="modal"
                                            data-target="#delete{{ $invoice->id }}"
                                            title="{{ trans('actions_trans.Delete') }}">
                                            {{ trans('actions_trans.Delete') }}
                                            <i class="fa fa-trash"></i>
                                        </a>
                                        
                                        
                                    </td>
                                </tr>

                            {{-- delete modal --}}
                            <div class="modal fade" id="delete{{ $invoice->id }}" tabindex="-1" role="dialog" 
                                 aria-labelledby="exampleModalLabel"  aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                                                {{ trans('invoices_trans.delete_invoice') }}
                                            </h5>
                                            <button type="button"
                                                class="close"
                                                data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('invoices.destroy', $invoice->id ) }}" method="post">
                                                {{ method_field('Delete') }}
                                                @csrf
                                                {{ trans('invoices_trans.deleteQ') }}
                                                <br>
                                                <input id="id" type="hidden" name="id" class="form-control" value="{{ $invoice->id }}">
                            
                                                <div class="modal-footer">
                                                    <button type="button"
                                                        class="btn btn-secondary"
                                                        data-dismiss="modal">{{ trans('actions_trans.Close') }}</button>
                                                    <button type="submit"
                                                        class="btn btn-danger">{{ trans('actions_trans.Delete') }}</button>
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
