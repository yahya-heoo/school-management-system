@extends('layouts.master')
@section('css')
@section('title')
{{trans('invoices_trans.add_invoice')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6" >
            <h4 class="mb-0" style="font-family: 'Cairo', sans-serif;" > {{trans('invoices_trans.add_invoice')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active"> {{trans('invoices_trans.add_invoice')}} </li>
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
                    
                        <form class=" row mb-30" action="{{ route('invoices.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class=" mb-3">
                                    
                                    <input type="hidden" name="student_id" value="{{ $student->id }}" />
                                    <h5 
                                        class="font-weight-bold mr-sm-2" style="font-family: 'Cairo', sans-serif;">{{ trans('students_trans.student_name') }} : {{$student->name ." ". $student->parents->father_name}}
                                    </h5>
                                    <hr>
                                </div>

                                <div class="repeater">
                                    <div data-repeater-list="invoices_list">
                                        <div data-repeater-item>
                                            <div class="row mb-2">
        
                                                
        
        
                                                <div class="col">
                                                    <label for="fee_id"
                                                        class="mr-sm-2">{{ trans('fees_trans.fee_type') }}
                                                    </label>
                                                    
                                                    <div class="box">
                                                        <select class="fancyselect" name="fee_id">
                                                            <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                                            @foreach ($fees as $fee)                      
                                                                <option value="{{ $fee->id }}">{{ $fee->fee_type }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                </div>
        
        
                                                <div class="col">
                                                    <div class="col">
                                                        <label for="amount" class="mr-sm-2">{{ trans('fees_trans.amount') }}</label>
                                                        <input type="number" class="form-control" name="amount" readonly>
                                                    </div>
        
                                                </div>
        
                                                <div class="col">
                                                    <div class="col">
                                                        <label for="description" class="mr-md-2">{{ trans('fees_trans.description') }}</label>
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
                                    
                                    <input type="hidden" name="grade_id" value="{{$student->grade_id}}">
                                    <input type="hidden" name="class_id" value="{{$student->class_id}}">

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




<script>

$(document).on('change', 'select[name$="[fee_id]"]', function() {
    var fee_id = $(this).val();
    var $row = $(this).closest('[data-repeater-item]');
    var $amountInput = $row.find('input[name$="[amount]"]');

    if (fee_id) {
        $.ajax({
            url: "{{ route('getAmounts', ':id') }}".replace(':id', fee_id),
            type: "GET",
            dataType: "json",
            success: function(data) {
                $amountInput.val(data.amount);
            },
            error: function(xhr) {
                console.log('Error:', xhr.responseText);
            }
        });
    } else {
        $amountInput.val('');
    }
});
</script>







@endsection

