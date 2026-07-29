<button class="btn btn-success btn-sm btn-lg pull-right" wire:click="showFormAdd" type="button">{{ trans('main_sidebar_trans.add_parent') }}</button><br><br>
<div class="table-responsive">
    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
           style="text-align: center">
        <thead>
        <tr class="table-success">
            <th>#</th>
            <th>{{ trans('Parent_trans.Email') }}</th>
            <th>{{ trans('Parent_trans.Name_Father') }}</th>
            <th>{{ trans('Parent_trans.National_ID_Father') }}</th>
            <th>{{ trans('Parent_trans.Passport_ID_Father') }}</th>
            <th>{{ trans('Parent_trans.Phone_Father') }}</th>
            <th>{{ trans('Parent_trans.Job_Father') }}</th>
            <th>{{ trans('grades_trans.Processes') }}</th>
        </tr>
        </thead>
        <tbody>
        <?php $i = 0; ?>
        @foreach ($TheParents as $TheParent)
            <tr>
                <?php $i++; ?>
                <td>{{ $i }}</td>
                <td>{{ $TheParent->email }}</td>
                <td>{{ $TheParent->father_name }}</td>
                <td>{{ $TheParent->father_national_id }}</td>
                <td>{{ $TheParent->father_passport_id }}</td>
                <td>{{ $TheParent->father_phone_number }}</td>
                <td>{{ $TheParent->father_job }}</td>
                <td>
                    <a href="{{ route('edit_parent', $TheParent->id) }}" 
                        class="btn btn-primary btn-sm"
                        title="{{ trans('grades_trans.edit') }}">
                         <i class="fa fa-edit"></i>
                     </a>
                    <button type="button" class="btn btn-danger btn-sm" wire:click="delete({{ $TheParent->id }})" title="{{ trans('grades_trans.delete') }}"><i class="fa fa-trash"></i></button>
                </td>
            </tr>
        @endforeach
    </table>
</div>