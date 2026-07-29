@extends('layouts.master')

@section('css')
@endsection

@section('title')
    {{trans('main_sidebar_trans.grades')}}
@endsection

@section('page-header')
<!-- breadcrumb -->
<div class="page-title" style="font-family: 'Cairo', sans-serif;">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0" style="font-family: 'Cairo', sans-serif;"> {{trans('main_sidebar_trans.grades')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active">{{trans('main_sidebar_trans.grades')}}</li>
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
        
        <center>
            @if ($errors->any())
            
                <div class="alert alert-danger">
                    <ul style="list-style: none">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            
            @endif
        </center>
        <div class="card card-statistics h-100">
            <button type="button" class="btnx-small btn-success " data-toggle="modal" 
            data-target="#exampleModal" title="{{trans('grades_trans.addGrade')}}" >
            {{trans('grades_trans.addGrade')}}    
            </button>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table mg-b-0 text-md-nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{trans('grades_trans.Name')}}</th>
                                <th>{{trans('grades_trans.Notes')}}</th>
                                <th>{{trans('grades_trans.Processes')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=0 ?>
                            @foreach ($grades as $grade)
                            <?php $i++ ?>
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$grade->name}}</td>
                                <td>{{$grade->notes}}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-info" data-toggle="modal" 
                                    data-target="#edit{{$grade->id}}" title="{{trans('grades_trans.edit')}}" ><i class="fa fa-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" 
                                    data-target="#delete{{$grade->id}}" title="{{trans('grades_trans.delete')}}" ><i class="fa fa-trash"></i>
                                    </button>

                                </td>
                            </tr>


                    {{-- edit modal --}}
                            <div class="modal fade" id="edit{{$grade->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                                            {{ trans('grades_trans.editGrade') }}
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        
                                        <form action="{{ route('grades.update', 'test') }}" method="post">
                                            {{ method_field('patch') }}
                                            @csrf
                                           
                                            <div class="row">
                                                <div class="col">
                                                    <label for="Name" class="mr-sm-2">{{ trans('grades_trans.stage_name_ar') }}
                                                        :</label>
                                                    <input id="Name" type="text" name="Name" class="form-control bg-info text-white"  value="{{ $grade->getTranslation('name', 'ar') }}">
                                                    <input id="id" type="hidden" name="id" class="form-control" value="{{ $grade->id }}">
                                                </div>
                                                <div class="col">
                                                    <label for="Name_en" class="mr-sm-2">{{ trans('grades_trans.stage_name_en') }}
                                                        :</label>
                                                    <input type="text" class="form-control bg-info text-white" name="Name_en"  value="{{ $grade->getTranslation('name', 'en') }}">
                                                </div>
                                            </div>
                                            <div class="form-group mt-2">
                                                <label for="exampleFormControlTextarea1">{{ trans('grades_trans.Notes') }}
                                                    :</label>
                                                <textarea class="form-control bg-info text-white" name="Notes" id="exampleFormControlTextarea1" value="{{$grade->notes}}
                                                    rows="3">{{$grade->notes}}</textarea>
                                            </div>
                                            <br><br>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">{{ trans('grades_trans.close') }}</button>
                                        <button type="submit" class="btn btn-info">{{ trans('grades_trans.edit') }}</button>
                                    </div>
                                    </form>

                                </div>
                            </div>
                            </div>
                    {{--end of  edit modal --}}

                    {{-- delete modal --}}
                            <div class="modal fade" id="delete{{$grade->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                                            {{ trans('grades_trans.deleteGrade') }}
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('grades.destroy', 'test') }}" method="post">
                                            {{ method_field('delete') }}
                                            @csrf

                                            <div class="form-group mb-5">
                                                <h3 style="font-family: 'Cairo', sans-serif;" class="m-2 ">{{ trans('grades_trans.deleteQ')}}</h3>
                                            </div>

                                            <div class="row">
                                                
                                                <div class="col">
                                                   
                                                    <input disabled id="Name" type="text" name="Name" class="form-control bg-danger text-white "  value="{{ $grade->getTranslation('name',App::getLocale()) }}">
                                                    <input id="id" type="hidden" name="id" class="form-control" value="{{ $grade->id }}">
                                                </div>
                                                
                                            </div>
                                            
                                            <br><br>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">{{ trans('grades_trans.close') }}</button>
                                        <button type="submit" class="btn btn-danger">{{ trans('grades_trans.delete') }}</button>
                                    </div>
                                    </form>

                                </div>
                            </div>
                            </div>
                    {{--end of  delete modal --}}

                            @endforeach

                            <!-- add_modal_Grade -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                                            {{ trans('grades_trans.addGrade') }}
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- add_form -->
                                        <form action="{{ route('grades.store') }}" method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col">
                                                    <label for="Name" class="mr-sm-2">{{ trans('grades_trans.stage_name_ar') }} : </label>
                                                    
                                                    <input id="Name" type="text" name="Name" class="form-control">
                                                </div>
                                                <div class="col">
                                                    <label for="Name_en" class="mr-sm-2">{{ trans('grades_trans.stage_name_en') }} : </label>
                                                    
                                                    <input type="text" class="form-control" name="Name_en">
                                                </div>
                                            </div>
                                            <div class="form-group mt-2">
                                                <label for="exampleFormControlTextarea1">{{ trans('grades_trans.Notes') }}
                                                    :</label>
                                                <textarea class="form-control" name="Notes" id="exampleFormControlTextarea1"
                                                    rows="3"></textarea>
                                            </div>
                                            <br><br>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">{{ trans('grades_trans.close') }}</button>
                                        <button type="submit" class="btn btn-success">{{ trans('grades_trans.submit') }}</button>
                                    </div>
                                    </form>

                                </div>
                            </div>
                            </div>
                            {{--end of  add modal --}}


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
