@extends('layouts.master')
@section('css')
@section('title')
{{trans('receipts_trans.add_receipt')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6" >
            <h4 class="mb-0" style="font-family: 'Cairo', sans-serif;" > {{trans('receipts_trans.add_receipt')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active"> {{trans('receipts_trans.add_receipt')}} </li>
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
                    
                        <form class=" row mb-30" action="{{ route('receipts.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class=" mb-3">
                                    <h5 for="student_id"
                                        class="font-weight-bold mr-sm-2" style="font-family: 'Cairo', sans-serif;">{{ trans('students_trans.student_name') }} :  {{$student->name ." ". $student->parents->father_name}}
                                    </h5>
                                    <input type="hidden" name="student_id" value="{{ $student->id }}" />
                                    <hr>
                                </div>

                                <div class="repeater">
                                    <div data-repeater-list="receipts_list">
                                        <div data-repeater-item>
                                            <div class="row mb-2">
                                                
                                                <div class="col">
                                                    <label for="invoice_id"
                                                        class="mr-sm-2">{{ trans('invoices_trans.type') }}
                                                    </label>
                                                        <select class="fancyselect" name="invoice_id">
                                                            <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                                            @foreach ($invoices as $invoice)                      
                                                                <option value="{{ $invoice->id }}">{{ $invoice->fees->fee_type }}</option>
                                                            @endforeach
                                                        </select>
                                                </div>              
                                                <div class="col">
                                                    <div class="col">
                                                        <label for="amount" class="mr-sm-2">{{ trans('receipts_trans.amount') }}</label>
                                                        <input type="number" class="form-control" name="amount">
                                                    </div>
                                                </div>
        
                                                <div class="col">
                                                    <div class="col">
                                                        <label for="description" class="mr-md-2">{{ trans('receipts_trans.description') }}</label>
                                                        <textarea name="description" class="form-control" id="" cols="10" rows="1"></textarea>
                                                    </div>
        
                                                </div>
        
                                                <div class="col">
                                                    <label 
                                                        class="mr-sm-2">{{ trans('classrooms_trans.Processes') }}
                                                    </label>
                                                    <input class="btn btn-danger btn-block" data-repeater-delete
                                                        type="button" value="{{ trans('classrooms_trans.deleteRow') }}" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-20">
                                        <div class="col-12">
                                            <input class="button" data-repeater-create type="button" value="{{ trans('classrooms_trans.addRow') }}"/>
                                        </div>
        
                                    </div>
                                    

                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success">{{ trans('actions_trans.confirm') }}</button>
                                    </div>
        
        
                                </div>
                            </div>
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
@endsection

