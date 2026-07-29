@if ($currentStep != 2)
    <div style="display: none" class="row setup-content" id="step-2">
@endif
<div class="col-xs-12">
    <div class="col-md-12">
        <br>

        <div class="form-row">
            <div class="col">
                <label for="title">{{ trans('Parent_trans.Name_Mother') }}</label>
                <input type="text" wire:model="mother_name" class="form-control">
                @error('mother_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col">
                <label for="title">{{ trans('Parent_trans.Name_Mother_en') }}</label>
                <input type="text" wire:model="mother_name_en" class="form-control">
                @error('mother_name_en')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-3">
                <label for="title">{{ trans('Parent_trans.Job_Mother') }}</label>
                <input type="text" wire:model="mother_job" class="form-control">
                @error('mother_job')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-3">
                <label for="title">{{ trans('Parent_trans.Job_Mother_en') }}</label>
                <input type="text" wire:model="mother_job_en" class="form-control">
                @error('mother_job_en')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col">
                <label for="title">{{ trans('Parent_trans.National_ID_Mother') }}</label>
                <input type="text" wire:model="mother_national_id" class="form-control">
                @error('mother_national_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col">
                <label for="title">{{ trans('Parent_trans.Passport_ID_Mother') }}</label>
                <input type="text" wire:model="mother_passport_id" class="form-control">
                @error('mother_passport_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col">
                <label for="title">{{ trans('Parent_trans.Phone_Mother') }}</label>
                <input type="text" wire:model="mother_phone_number" class="form-control">
                @error('mother_phone_number')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

        </div>


        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputCity">{{ trans('Parent_trans.Nationality_Father_id') }}</label>
                <select class="custom-select my-1 mr-sm-2" wire:model="nationality_mother_id">
                    <option selected>{{ trans('Parent_trans.Choose') }}...</option>
                    @foreach ($Nationalities as $Nationality)
                        <option value="{{ $Nationality->id }}">{{ $Nationality->name }}</option>
                    @endforeach
                </select>
                @error('nationality_mother_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group col">
                <label for="inputState">{{ trans('Parent_trans.Blood_Type_Father_id') }}</label>
                <select class="custom-select my-1 mr-sm-2" wire:model="blood_type_mother_id">
                    <option selected>{{ trans('Parent_trans.Choose') }}...</option>
                    @foreach ($Type_Bloods as $Type_Blood)
                        <option value="{{ $Type_Blood->id }}">{{ $Type_Blood->name }}</option>
                    @endforeach
                </select>
                @error('blood_type_mother_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group col">
                <label for="inputZip">{{ trans('Parent_trans.Religion_Father_id') }}</label>
                <select class="custom-select my-1 mr-sm-2" wire:model="religion_mother_id">
                    <option selected>{{ trans('Parent_trans.Choose') }}...</option>
                    @foreach ($Religions as $Religion)
                        <option value="{{ $Religion->id }}">{{ $Religion->name }}</option>
                    @endforeach
                </select>
                @error('religion_mother_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="exampleFormControlTextarea1">{{ trans('Parent_trans.Address_Mother') }}</label>
            <textarea class="form-control" wire:model="mother_address" id="exampleFormControlTextarea1" rows="4"></textarea>
            @error('mother_address')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <button class="btn btn-danger btn-sm nextBtn btn-lg pull-right" type="button" wire:click="back(1)">
            {{ trans('Parent_trans.Back') }}
        </button>

        <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="button"
            wire:click="secondStepSubmit">{{ trans('Parent_trans.Next') }}</button>

    </div>
</div>
</div>
