@extends('layouts.master')
@section('css')

@section('title')
    {{ trans('library_trans.library_resources') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0" style="font-family: 'Cairo', sans-serif;">
                {{ trans('library_trans.library_resources') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active"> {{ trans('library_trans.library_resources') }} </li>
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

                <a class="btn btn-success btn-sm btn-lg pull-right mb-2" href="{{ route('library-resources.create') }}">
                    {{ trans('library_trans.add_resource') }}
                </a>

                <div class="table-responsive">
                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                        style="text-align: center">
                        <thead>
                            <tr class="table-info">
                                <th>#</th>
                                <th>{{ trans('library_trans.resource_title') }}</th>
                                <th>{{ trans('grades_trans.grade') }}</th>
                                <th>{{ trans('classrooms_trans.class') }}</th>
                                <th>{{ trans('sections_trans.section') }}</th>
                                <th>{{ trans('teachers_trans.teacher_name') }}</th>
                                <th>{{ trans('students_trans.processes') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach ($library_resources as $library_resource)
                                <tr>
                                    <?php $i++; ?>
                                    <td>{{ $i }}</td>
                                    <td>{{ $library_resource->title }}</td>

                                    <td>{{ $library_resource->grades->name }}</td>
                                    <td>{{ $library_resource->classes->name }}</td>
                                    <td>{{ $library_resource->sections->name }}</td>
                                    <td>{{ $library_resource->teachers->name }}</td>
                                    <td>
                                        <a href="{{ route('library-resources.edit', $library_resource->id) }}"
                                            class="btn btn-primary btn-sm" title="{{ trans('actions_trans.edit') }}">
                                            {{ trans('actions_trans.edit') }}
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="{{ route('download_resource',$library_resource->id) }}"
                                                    class="btn btn-success btn-sm"
                                                    title="{{ trans('actions_trans.download') }}">
                                                    {{ trans('actions_trans.download') }}
                                                    <i class="fa fa-download m-1"></i>
                                                </a>

                                        <a href="#" class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target="#delete{{ $library_resource->id }}"
                                            title="{{ trans('actions_trans.Delete') }}">
                                            {{ trans('actions_trans.Delete') }}
                                            <i class="fa fa-trash"></i>
                                        </a>

                                        


                                    </td>
                                </tr>

                                {{-- delete modal --}}
                                <div class="modal fade" id="delete{{ $library_resource->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                    id="exampleModalLabel">
                                                    {{ trans('library_trans.delete_library_resource') }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form
                                                    action="{{ route('library-resources.destroy', $library_resource->id) }}"
                                                    method="post">
                                                    {{ method_field('Delete') }}
                                                    @csrf
                                                    {{ trans('library_trans.deleteQ') }}
                                                    <br>
                                                    <input id="id" type="hidden" name="id"
                                                        class="form-control" value="{{ $library_resource->id }}">

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
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
