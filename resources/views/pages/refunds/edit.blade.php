@extends('layouts.master')
@section('css')

@section('title')
    {{ trans('refunds_trans.edit_refund') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0" style="font-family: 'Cairo', sans-serif;"> {{ trans('refunds_trans.edit_refund') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active"> {{ trans('refunds_trans.edit_refund') }} </li>
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


                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                <div class="col-xs-12">
                    <div class="col-md-12">
                        <br>
                        <form action="{{ route('refunds.update', $refund->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="id" value="{{ $refund->id }}">

                            <div class="form-row">

                                <div class="form-group col">
                                    <label for="student_id" class="mr-sm-2">{{ trans('students_trans.student_name') }}
                                    </label>
                                    <input readonly class="form-control form-control-lg" type="text"
                                        value="{{ $refund->students->name .' '.$refund->students->parents->father_name}}" />

                                    @error('student_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col">
                                    <label for="invoice_id"
                                        class="mr-sm-2">{{ trans('invoices_trans.type') }}
                                    </label>
                                    <select class="form-control form-control-lg" name="invoice_id">
                                        <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                        @foreach ($related_invoices as $invoice)                      
                                            <option value="{{ $invoice->id }}">{{ $invoice->fees->fee_type ." | ".$invoice->invoice_amount }}</option>
                                        @endforeach
                                    </select>
                                </div> 

                                <div class="form-group col">
                                    <label>{{ trans('refunds_trans.amount') }}</label>
                                    <input type="number" value="{{$refund->debit}}" class="form-control form-control-lg" name="amount">
                                    @error('amount')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>


                            </div>


                            <div class="form-group ">
                                <label for="exampleFormControlTextarea1">{{ trans('refunds_trans.description') }}</label>
                                <textarea class="form-control" name='description' id="exampleFormControlTextarea1" rows="4">
                                    {{ $refund->refund_description }}
                                </textarea>
                                @error('description')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>



                            <button class="btn btn-info btn-sm nextBtn btn-lg pull-right" type="submit">
                                {{ trans('actions_trans.edit') }}
                            </button>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection

@section('js')

{{-- <script>
    $(document).ready(function() {
        // Initialize with existing amount
        $('#amount_input').val('{{ $refund->amount }}');

        function updateAmount(feeId) {
            $.ajax({
                url: "{{ route('getAmounts', '') }}/" + feeId,
                method: 'GET',
                success: function(response) {
                    $('#amount_input').val(response.amount);
                },
                error: function(xhr) {
                    console.error(xhr);
                }
            });
        }

        // Handle fee change
        $('select[name="fee_id"]').on('change', function() {
            const feeId = $(this).val();
            if (feeId) {
                updateAmount(feeId);
            } else {
                $('#amount_input').val('');
            }
        });

        // Initial load if fee is selected
        const initialFeeId = $('select[name="fee_id"]').val();
        if (initialFeeId) {
            updateAmount(initialFeeId);
        }
    });
</script> --}}




@endsection
