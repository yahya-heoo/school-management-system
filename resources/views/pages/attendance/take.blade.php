@extends('layouts.master')
@section('css')

@section('title')
    {{ trans('attendances_trans.attendances') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0" style="font-family: 'Cairo', sans-serif;"> {{ trans('attendances_trans.attendances') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active"> {{ trans('attendances_trans.attendances') }} </li>
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
            <h5 class="text-danger font-weight-bold" style="font-family: 'Cairo', sans-serif;">{{trans('attendances_trans.date_of_day') }} : {{date('Y-m-d')}}</h5>
            <hr><br>
            <form action="{{ route('attendances.store') }}" method="POST">
                @csrf
                <div class="table-responsive">
                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                        style="text-align: center">
                        <thead>
                            <tr class="table-primary">
                                <th>#</th>
                                <th>{{ trans('students_trans.student_name') }}</th>                               
                                <th>{{ trans('students_trans.grade') }}</th>
                                <th>{{ trans('students_trans.class') }}</th>
                                <th>{{ trans('students_trans.section') }}</th>
                                <th>{{ trans('students_trans.processes') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach ($students as $student)
                                <tr>
                                    <?php $i++; ?>
                                    <td>{{ $i }}</td>
                                    <td>{{ $student->name }}</td>
                                    <td>{{$student->grades->name}}</td>
                                    <td>{{$student->classes->name}}</td>
                                    <td>{{$student->sections->name}}</td>

                                    @php
                                        $todayAttendance = $student->attendances
                                            ->where('attendance_date', date('Y-m-d'))
                                            ->first();
                                    @endphp

                                    <td class=" {{ $todayAttendance ? 'bg-light' : '' }}">
                                        
                                        @foreach (['presence' => 1, 'absent' => 0] as $label => $status)
                                            <label class="text-{{ $status ? 'success' : 'danger' }} font-weight-bold">
                                                <input class="leading-tight {{ $status ? '' : 'ml-3' }}"
                                                    type="radio"
                                                    name="attendances[{{ $student->id }}]"
                                                    value="{{ $label }}"
                                                    {{ $todayAttendance ? 'disabled' : '' }}
                                                    {{ $todayAttendance && $todayAttendance->attendance_status == $status ? 'checked' : '' }}>
                                                {{ trans("attendances_trans.$label") }}
                                            </label>
                                        @endforeach

                                        <input type="hidden" name="student_id[]" value="{{$student->id}}">
                                        <input type="hidden" name="grade_id" value="{{$student->grade_id}}">
                                        <input type="hidden" name="class_id" value="{{$student->class_id}}">
                                        <input type="hidden" name="section_id" value="{{$student->section_id}}">
                                    </td>


                                </tr>
                            
                            @endforeach
                        </tbody>
                    </table>

                    <button class="btn btn-success btn-lg pull-right mt-2" type="submit" >{{ trans('actions_trans.confirm') }}</button>
                
                </div>

            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
