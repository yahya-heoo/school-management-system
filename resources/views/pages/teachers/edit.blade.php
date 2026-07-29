@extends('layouts.master')
@section('css')

@section('title')
{{trans('teachers_trans.edit_teacher')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6" >
            <h4 class="mb-0" style="font-family: 'Cairo', sans-serif;" > {{trans('teachers_trans.edit_teacher')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active"> {{trans('teachers_trans.edit_teacher')}} </li>
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
                        <br>
                        <form action="{{ route('teachers.update',$teacher->id) }}" method="POST">
                            @csrf
                            {{ method_field('patch') }}
                        <div class="form-row mb-2">
                            <input type="hidden" name="id"  value="{{$teacher->id}}">

                            <div class="col">
                                <label for="title">{{ trans('teachers_trans.teacher_name_ar') }}</label>
                                <input type="text" name="teacher_name_ar" class="form-control" value="{{$teacher->getTranslation('name','ar') }}">
                                @error('teacher_name_ar')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="title">{{ trans('teachers_trans.teacher_name_en') }}</label>
                                <input type="text" name="teacher_name_en" class="form-control" value="{{$teacher->getTranslation('name','en')}}">
                                @error('teacher_name_en')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <hr>
                        <div class="form-row mb-2">
                            

                            <div class="form-group col">
                                <label for="title">{{trans('teachers_trans.email')}}</label>
                                <input type="email" name="email"  class="form-control" value="{{$teacher->email}}">
                                @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col">
                                <label for="title">{{trans('teachers_trans.password')}}</label>
                                <input type="password" name="password" class="form-control" placeholder="{{ trans('teachers_trans.optional_for_update') }}" >
                                @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            
                        </div>
                        

                        <div class="form-row">
                            
                            <div class="form-group col">
                                <label for="inputState">{{ trans('teachers_trans.teacher_gender') }}</label>
                                <select class="custom-select my-1 mr-sm-2" name="gender_id">
                                    
                                    @foreach ($genders as $gender)
                                    <option value="{{ $gender->id }}" {{ $teacher->gender_id == $gender->id ? 'selected' : '' }}>{{ $gender->name }}</option>
                                    @endforeach
                                </select>
                                @error('gender_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col">
                                <label for="inputZip">{{ trans('teachers_trans.teacher_specialization') }}</label>
                                <select class="custom-select my-1 mr-sm-2" name="specialization_id">
                                    
                                    @foreach ($specializations as $specialization)
                                    <option value="{{ $specialization->id }}" {{ $teacher->specialization_id == $specialization->id ? 'selected' : '' }}>{{ $specialization->name }}</option>
                                    @endforeach
                                </select>
                                @error('specialization_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <hr>
                        
                        <div class="form-group">
                            <div class="form-group ">
                                <label for="title">{{ trans('teachers_trans.joining_date') }}</label>
                                <input type="date" name="joining_date" class="form-control" value="{{$teacher->joining_date}}">
                                @error('joining_date')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group ">
                            <label for="exampleFormControlTextarea1">{{ trans('teachers_trans.address') }}</label>
                            <textarea class="form-control" name='address' id="exampleFormControlTextarea1" rows="4" >{{$teacher->address}}</textarea>
                            @error('address')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                
                        
                
                        <button   class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit" 
                            >{{ trans('grades_trans.edit') }}</button>
                
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
