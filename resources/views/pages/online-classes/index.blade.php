@extends('layouts.master')
@section('css')

@section('title')
    {{ trans('online_classes_trans.online_classes') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0" style="font-family: 'Cairo', sans-serif;"> {{ trans('online_classes_trans.online_classes') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active"> {{ trans('online_classes_trans.online_classes') }} </li>
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

                <a class="btn btn-success btn-sm btn-lg pull-right" href="{{ route('online-classes.create', ['integration' => 1] ) }}">
                {{ trans('online_classes_trans.new_zoom_meeting') }} 
                </a>
                <a class="btn btn-warning btn-sm btn-lg pull-right ml-1 mr-1" href="{{ route('online-classes.create', ['integration' => 0]) }}">
                {{ trans('online_classes_trans.add_existing_meeting') }} 
                </a>
                     <br>
                     <br>
                <div class="table-responsive">
                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                        style="text-align: center">
                        <thead>
                            <tr class="table-success">
                                <th>#</th>
                                <th>{{ trans('grades_trans.grade') }}</th>
                                <th>{{ trans('classrooms_trans.class') }}</th>
                                <th>{{ trans('sections_trans.section') }}</th>
                                <th>{{ trans('teachers_trans.teacher') }}</th>
                                <th>{{ trans('online_classes_trans.topic') }}</th>
                                <th>{{ trans('online_classes_trans.start_time') }}</th>
                                <th>{{ trans('online_classes_trans.duration') }}</th>
                                <th>{{ trans('online_classes_trans.join_url') }}</th>
                                <th>{{ trans('students_trans.processes') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach ($onlineClasses as $onlineClass)
                                <tr>
                                    <?php $i++; ?>
                                    <td>{{ $i }}</td>
                                    <td>{{$onlineClass->grades->name }}</td>
                                    <td>{{$onlineClass->classes->name}}</td>
                                    <td>{{$onlineClass->sections->name}}</td>
                                    <td>{{$onlineClass->users->name}}</td>
                                    <td>{{$onlineClass->topic}}</td>
                                    <td>{{$onlineClass->start_time}}</td>
                                    <td>{{$onlineClass->duration}}</td>
                                    <td>{{$onlineClass->join_url}}</td>
                                    <td>
                                        <a href="{{ route('online-classes.edit', $onlineClass->id) }}"
                                            class="btn btn-primary btn-sm" title="{{ trans('actions_trans.edit') }}">
                                            {{ trans('actions_trans.edit') }}
                                            <i class="fa fa-edit"></i>
                                        </a>
                                       
                                    
                                        <a href="#"
                                            class="btn btn-danger btn-sm"
                                            data-toggle="modal"
                                            data-target="#delete{{ $onlineClass->id }}"
                                            title="{{ trans('actions_trans.Delete') }}">
                                            {{ trans('actions_trans.Delete') }}
                                            <i class="fa fa-trash"></i>
                                        </a>
                                        
                                        
                                    </td>
                                </tr>

                            {{-- delete modal --}}
                            <div class="modal fade" id="delete{{ $onlineClass->id }}" tabindex="-1" role="dialog" 
                                 aria-labelledby="exampleModalLabel"  aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                                                {{ trans('online_classes_trans.delete_online-class') }}
                                            </h5>
                                            <button type="button"
                                                class="close"
                                                data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('online-classes.destroy', $onlineClass->id ) }}" method="post">
                                                {{ method_field('Delete') }}
                                                @csrf
                                                {{ trans('online_classes_trans.deleteQ') }}
                                                <br>
                                                <input id="id" type="hidden" name="id" class="form-control" value="{{ $onlineClass->id }}">
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
