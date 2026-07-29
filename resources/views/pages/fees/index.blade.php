@extends('layouts.master')
@section('css')

@section('title')
    {{ trans('fees_trans.fees') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0" style="font-family: 'Cairo', sans-serif;"> {{ trans('fees_trans.fees') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active"> {{ trans('fees_trans.fees') }} </li>
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

                <a class="btn btn-success btn-sm btn-lg pull-right" href="{{ route('fees.create') }}">
                {{ trans('fees_trans.add_fee') }} 
                </a>
                     <br>
                     <br>
                <div class="table-responsive">
                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                        style="text-align: center">
                        <thead>
                            <tr class="table-warning">
                                <th>#</th>
                                <th>{{ trans('fees_trans.type') }}</th>
                                <th>{{ trans('fees_trans.amount') }}</th>
                                <th>{{ trans('students_trans.grade') }}</th>
                                <th>{{ trans('students_trans.class') }}</th>
                                <th>{{ trans('students_trans.acdemic_year') }}</th>
                                <th>{{ trans('fees_trans.description') }}</th>
                                <th>{{ trans('students_trans.processes') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach ($fees as $fee)
                                <tr>
                                    <?php $i++; ?>
                                    <td>{{ $i }}</td>
                                    <td>{{ $fee->fee_type }}</td>
                                    <td>{{$fee->fee_amount}}</td>
                                    <td>{{$fee->grades->name}}</td>
                                    <td>{{$fee->classes->name}}</td>
                                    <td>{{$fee->academic_year}}</td>
                                    <td>{{$fee->fee_description}}</td>
                                    <td>
                                        <a href="{{ route('fees.edit', $fee->id) }}"
                                            class="btn btn-primary btn-sm" title="{{ trans('actions_trans.edit') }}">
                                            {{ trans('actions_trans.edit') }}
                                            <i class="fa fa-edit"></i>
                                        </a>
                                       
                                    
                                        <a href="#"
                                            class="btn btn-danger btn-sm"
                                            data-toggle="modal"
                                            data-target="#delete{{ $fee->id }}"
                                            title="{{ trans('actions_trans.Delete') }}">
                                            {{ trans('actions_trans.Delete') }}
                                            <i class="fa fa-trash"></i>
                                        </a>
                                        
                                        
                                    </td>
                                </tr>

                            {{-- delete modal --}}
                            <div class="modal fade" id="delete{{ $fee->id }}" tabindex="-1" role="dialog" 
                                 aria-labelledby="exampleModalLabel"  aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                                                {{ trans('fees_trans.delete_fee') }}
                                            </h5>
                                            <button type="button"
                                                class="close"
                                                data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('fees.destroy', $fee->id ) }}" method="post">
                                                {{ method_field('Delete') }}
                                                @csrf
                                                {{ trans('fees_trans.deleteQ') }}
                                                <br>
                                                <input id="id" type="hidden" name="id" class="form-control" value="{{ $fee->id }}">
                                                <input  type="text" name="name" disabled class="form-control bg-danger text-white mt-1" value="{{ $fee->fee_type }}">
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
