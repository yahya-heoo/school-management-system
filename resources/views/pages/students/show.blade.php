@extends('layouts.master')
@section('css')

@section('title')
    {{ trans('students_trans.student_information') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0" style="font-family: 'Cairo', sans-serif;">
                {{ trans('students_trans.student_information') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active"> {{ trans('students_trans.student_information') }} </li>
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

                <ul class="nav nav-pills border-0 shadow-none mb-3" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" style="border: none; border-radius: 0.25rem;" id="profile-tab"
                            data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab"
                            aria-controls="profile" aria-selected="false">
                            {{ trans('students_trans.student_information') }}
                        </button>
                    </li>

                    <li class="nav-item" role="presentation">
                        <button class="nav-link" style="border: none; border-radius: 0.25rem;" id="home-tab"
                            data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab"
                            aria-controls="home" aria-selected="true">
                            {{ trans('students_trans.attachments') }}
                        </button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">

                    <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12"> <!-- Full width container -->
                                        <div class="row"> <!-- Nested row for 3 columns -->
                                            <!-- First Column -->
                                            <div class="col-md-4 border-end">
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item">
                                                        <strong>{{ trans('students_trans.student_name') }} : </strong>
                                                        {{ $student->name }}
                                                    </li>
                                                    <li class="list-group-item">
                                                        <strong>{{ trans('students_trans.grade') }} : </strong>
                                                        {{ $student->grade->name }}
                                                    </li>
                                                    <li class="list-group-item">
                                                        <strong>{{ trans('students_trans.student_gender') }} :
                                                        </strong> {{ $student->gender->name }}
                                                    </li>
                                                    <li class="list-group-item">
                                                        <strong>{{ trans('students_trans.acdemic_year') }} : </strong>
                                                        {{ $student->academic_year }}
                                                    </li>
                                                </ul>
                                            </div>

                                            <!-- Second Column -->
                                            <div class="col-md-4 border-end">
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item">
                                                        <strong>{{ trans('Parent_trans.Name_Father') }} : </strong>
                                                        {{ $student->parent->father_name }}
                                                    </li>
                                                    <li class="list-group-item">
                                                        <strong>{{ trans('students_trans.class') }} : </strong>
                                                        {{ $student->class->name }}
                                                    </li>
                                                    <li class="list-group-item">
                                                        <strong>{{ trans('students_trans.Blood_Type') }} : </strong>
                                                        {{ $student->blood_type->name }}
                                                    </li>
                                                    <li class="list-group-item">
                                                        <strong>{{ trans('students_trans.birth_date') }} : </strong>
                                                        {{ $student->birth_date }}
                                                    </li>


                                                </ul>
                                            </div>

                                            <!-- Third Column -->
                                            <div class="col-md-4">
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item">
                                                        <strong>{{ trans('Parent_trans.Name_Mother') }} : </strong>
                                                        {{ $student->parent->mother_name }}
                                                    </li>

                                                    <li class="list-group-item">
                                                        <strong>{{ trans('students_trans.section') }} : </strong>
                                                        {{ $student->section->name }}
                                                    </li>
                                                    <li class="list-group-item">
                                                        <strong>{{ trans('students_trans.student_nationality') }} :
                                                        </strong>
                                                        {{ $student->nationality->name }}
                                                    </li>

                                                    <li class="list-group-item">
                                                        <strong>{{ trans('students_trans.email') }} : </strong>
                                                        {{ $student->email }}
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>







                    <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">

                        <div class="card shadow">
                            <form class="card-body" action="{{ route('upload_attachments') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <lable class="text-danger " for="attachment">
                                        {{ trans('students_trans.new_attachments') }}</lable>
                                    <br>
                                    <input class="mt-3" type="file" name="attachments[]" multiple accept="image/*">
                                    <input type="hidden" name="student_id" value="{{ $student->id }}">

                                    <br><br>
                                    <input class="btn btn-success bt-lg" type="submit"
                                        value="{{ trans('actions_trans.confirm') }}">
                                </div>
                            </form>
                        </div>


                        <div class="table-responsive">
                            <br>
                            <table class="table   table-hover table-sm table-bordered p-0" style="text-align: center">
                                <thead class="table-success">
                                    <tr>
                                        <th>#</th>
                                        <th>{{ trans('students_trans.attachments') }}</th>
                                        <th>{{ trans('students_trans.preview') }}</th>
                                        <th>{{ trans('grades_trans.Processes') }}</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($student->attachments as $attachment)
                                        <tr>

                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $attachment->file_name }}</td>
                                            <td>
                                                <a target="_blank"
                                                    href="{{ asset($attachment->storage_path) }}"
                                                    target="_blank">
                                                    <img src="{{ asset($attachment->storage_path) }}"
                                                        width="100px" height="100px">
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{ route('download_attachments',$attachment->id) }}"
                                                    class="btn btn-outline-success btn-md"
                                                    title="{{ trans('grades_trans.edit') }}">
                                                    {{ trans('students_trans.download') }}
                                                    <i class="fa fa-download m-1"></i>
                                                </a>

                                                <a href="#" class="btn btn-outline-danger btn-md"
                                                    data-toggle="modal" data-target="#delete{{ $attachment->id }}"
                                                    title="{{ trans('grades_trans.delete') }}">
                                                    {{ trans('students_trans.Delete') }}
                                                    <i class="fa fa-trash m-1"></i>
                                                </a>


                                            </td>
                                        </tr>

                                        {{-- delete modal --}}
                                        <div class="modal fade" id="delete{{ $attachment->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 style="font-family: 'Cairo', sans-serif;"
                                                            class="modal-title" id="exampleModalLabel">
                                                            {{ trans('actions_trans.Delete') }}
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form
                                                            action="{{ route('delete_attachments', $attachment->id) }}"
                                                            method="POST">
                                                            @csrf


                                                            <div class="modal-body">
                                                                <labelhidden>
                                                                    {{ trans('students_trans.deleteQ') }}</label>
                                                                    <br>
                                                                    <input disabled id="Name" type="text"
                                                                        name="Name"
                                                                        class="form-control bg-danger text-white "
                                                                        value="{{ $attachment->attachmentable->getTranslation('name', App::getLocale()) }}">
                                                                    <input type="hidden" name="student_id"
                                                                        value="{{ $student->id }}">
                                                                    <input type="hidden" name="attachment_id"
                                                                        value="{{ $attachment->id }}">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">{{ trans('students_trans.Close') }}</button>
                                                                <button type="submit"
                                                                    class="btn btn-danger">{{ trans('students_trans.Delete') }}</button>
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
    </div>


    <!-- row closed -->
@endsection
@section('js')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    </script>
@endsection
