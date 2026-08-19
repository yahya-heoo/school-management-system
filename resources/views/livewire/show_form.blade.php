@extends('layouts.master')
@section('css')
@section('title')
@if($editMode ?? false)
{{ trans('Parent_trans.edit_parent') }}

@else
{{ trans('main_sidebar_trans.add_parent') }}
@endif

@stop

@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title" style="font-family: 'Cairo', sans-serif;">
    <div class="row">
        <div clas6s="col-sm-6">
            <h4 class="mb-0" style="font-family: 'Cairo', sans-serif;"> 
                @if($editMode ?? false)
                    {{ trans('Parent_trans.edit_parent') }}
                    
                @else
                    {{ trans('main_sidebar_trans.add_parent') }}
                @endif
            </h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active">
                    @if($editMode ?? false)
                    {{ trans('Parent_trans.edit_parent') }}
                    
                @else
                    {{ trans('main_sidebar_trans.add_parent') }}
                @endif </li>
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
                @livewire('add-parent', [
                    'editMode' => $editMode ?? false,
                    'parent_id' => $parent_id ?? null
                ])
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')
@endsection
