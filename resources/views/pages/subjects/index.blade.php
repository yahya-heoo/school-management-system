@extends('layouts.master')
@section('css')

@section('title')
    {{ trans('subjects_trans.subjects') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0" style="font-family: 'Cairo', sans-serif;"> {{ trans('subjects_trans.subjects') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active"> {{ trans('subjects_trans.subjects') }} </li>
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

                <a class="btn btn-success btn-sm btn-lg pull-right" href="{{ route('subjects.create') }}">
                {{ trans('subjects_trans.add_subject') }} 
                </a>
                     <br>
                     <br>
                <div class="table-responsive">
                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                        style="text-align: center">
                        <thead>
                            <tr class="table-danger  ">
                                <th>#</th>
                                <th>{{ trans('subjects_trans.subject_name') }}</th>                               
                                <th>{{ trans('subjects_trans.grade') }}</th>
                                <th>{{ trans('subjects_trans.class') }}</th>
                                <th>{{ trans('teachers_trans.teacher_name') }}</th>
                                <th>{{ trans('students_trans.processes') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach ($subjects as $subject)
                                <tr>
                                    <?php $i++; ?>
                                    <td>{{ $i }}</td>
                                    <td>{{ $subject->specializations->name }}</td>
                                    <td>{{$subject->grades->name}}</td>
                                    <td>{{$subject->classes->name}}</td>
                                    <td>{{ $subject->teachers->map(fn($teacher) => $teacher->name)->join(', ') }}</td>
                                    
                                    <td>
                                        <a href="{{ route('subjects.edit', $subject->id) }}"
                                            class="btn btn-primary btn-sm" title="{{ trans('actions_trans.edit') }}">
                                            {{ trans('actions_trans.edit') }}
                                            <i class="fa fa-edit"></i>
                                        </a>
                                       
                                    
                                        <a href="#"
                                            class="btn btn-danger btn-sm"
                                            data-toggle="modal"
                                            data-target="#delete{{ $subject->id }}"
                                            title="{{ trans('actions_trans.Delete') }}">
                                            {{ trans('actions_trans.Delete') }}
                                            <i class="fa fa-trash"></i>
                                        </a>
                                        
                                        
                                    </td>
                                </tr>

                            {{-- delete modal --}}
                            <div class="modal fade" id="delete{{ $subject->id }}" tabindex="-1" role="dialog" 
                                 aria-labelledby="exampleModalLabel"  aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                                                {{ trans('subjects_trans.delete_subject') }}
                                            </h5>
                                            <button type="button"
                                                class="close"
                                                data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('subjects.destroy', $subject->id ) }}" method="post">
                                                {{ method_field('Delete') }}
                                                @csrf
                                              <div class="modal-body">
                                                <p> {{ trans('subjects_trans.deleteQ') }}</p>
                                               
                                                <input id="id" type="hidden" name="id" class="form-control" value="{{ $subject->id }}">
                                                <input  type="text" name="name" disabled class="form-control bg-danger text-white mt-1 " value="{{ $subject->specializations->name }}">
                                              </div>
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
