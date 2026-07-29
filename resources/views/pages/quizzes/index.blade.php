@extends('layouts.master')
@section('css')

@section('title')
    {{ trans('quizzes_trans.quizzes') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0" style="font-family: 'Cairo', sans-serif;"> {{ trans('quizzes_trans.quizzes') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active"> {{ trans('quizzes_trans.quizzes') }} </li>
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

                <a class="btn btn-success btn-sm btn-lg pull-right mb-2" href="{{ route('quizzes.create') }}">
                {{ trans('quizzes_trans.add_quiz') }} 
                </a>

                <div class="table-responsive">
                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                        style="text-align: center">
                        <thead>
                            <tr class="table-warning">
                                <th>#</th>
                                <th>{{ trans('quizzes_trans.title') }}</th>
                                <th>{{ trans('subjects_trans.subject_name') }}</th>
                                <th>{{ trans('quizzes_trans.grade') }}</th>
                                <th>{{ trans('quizzes_trans.class') }}</th>
                                <th>{{ trans('quizzes_trans.section') }}</th>
                                <th>{{ trans('teachers_trans.teacher_name') }}</th>
                                <th>{{ trans('students_trans.processes') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach ($quizzes as $quizz)
                                <tr>
                                    <?php $i++; ?>
                                    <td>{{ $i }}</td>
                                    <td>{{$quizz->title}}</td>
                                    <td>{{$quizz->subjects->name}}</td>
                                    <td>{{$quizz->sections->clasess->grades->name}}</td>
                                    <td>{{$quizz->sections->classes->name}}</td>
                                    <td>{{$quizz->sections->name}}</td>
                                    <td>{{$quizz->teachres->name}}</td>
                                    <td>
                                        <a href="{{ route('quizzes.edit', $quizz->id) }}"
                                            class="btn btn-primary btn-sm" title="{{ trans('actions_trans.edit') }}">
                                            {{ trans('actions_trans.edit') }}
                                            <i class="fa fa-edit"></i>
                                        </a>
                                       
                                    
                                        <a href="#"
                                            class="btn btn-danger btn-sm"
                                            data-toggle="modal"
                                            data-target="#delete{{ $quizz->id }}"
                                            title="{{ trans('actions_trans.Delete') }}">
                                            {{ trans('actions_trans.Delete') }}
                                            <i class="fa fa-trash"></i>
                                        </a>
                                        
                                        
                                    </td>
                                </tr>

                            {{-- delete modal --}}
                            <div class="modal fade" id="delete{{ $quizz->id }}" tabindex="-1" role="dialog" 
                                 aria-labelledby="exampleModalLabel"  aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                                                {{ trans('quizzes_trans.delete_quizz') }}
                                            </h5>
                                            <button type="button"
                                                class="close"
                                                data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('quizzes.destroy', $quizz->id ) }}" method="post">
                                                {{ method_field('Delete') }}
                                                @csrf
                                                {{ trans('quizzes_trans.deleteQ') }}
                                                <br>
                                                <input id="id" type="hidden" name="id" class="form-control" value="{{ $quizz->id }}">
                            
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
