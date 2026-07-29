<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Religion;
use App\Models\BloodType;
use App\Models\TheParents;
use App\Models\Nationality;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Traits\HandlingAttachmentsTrait;

class AddParent extends Component
{
    use WithFileUploads;
    use HandlingAttachmentsTrait;

    public $currentStep = 1, $catchError,  $photos, $parent_id,
        $editMode = false,
        $showTable = true,
        $successMessage = '',


        // Father_INPUTS
        $email, $password,
        $father_name, $father_name_en,
        $father_national_id, $father_passport_id,
        $father_phone_number, $father_job, $father_job_en,
        $nationality_father_id, $blood_type_father_id,
        $father_address, $religion_father_id,

        // Mother_INPUTS
        $mother_name, $mother_name_en,
        $mother_national_id, $mother_passport_id,
        $mother_phone_number, $mother_job, $mother_job_en,
        $nationality_mother_id, $blood_type_mother_id,
        $mother_address, $religion_mother_id;



    public function render()
    {
        return view('livewire.add-parent', [
            'Nationalities' => Nationality::all(),
            'Type_Bloods' => BloodType::all(),
            'Religions' => Religion::all(),
            'TheParents' => TheParents::all(),
            'editMode' => $this->editMode,
        ]);
    }



    public function showFormAdd()
    {
        $this->clearForm();
        $this->showTable = false;
    }

    protected function skipUniqueValidations(&$rules)
    {
        $fieldsToSkip = [
            'email',
            'password',
            'father_national_id',
            'mother_national_id',
            'father_passport_id',
            'mother_passport_id',
        ];

        foreach ($fieldsToSkip as $field) {
            if (isset($rules[$field])) {
                unset($rules[$field]);
            }
        }
    }

    public function updated($propertyName)
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required|min:6',
            'father_national_id' => 'required|string|max:10|min:10|regex:/[0-9]{9}/',
            'mother_national_id' => 'required|string|max:10|min:10|regex:/[0-9]{9}/',
            'father_passport_id' => 'max:10|min:10',
            'mother_passport_id' => 'max:10|min:10',
            'father_phone_number' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'mother_phone_number' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        ];
        if ($this->editMode) {
            $this->skipUniqueValidations($rules);
        } else {
            $this->validateOnly($propertyName, $rules);
        }
    }



    public function firstStepSubmit()
    {

        $rules = [
            'email' => 'required|email|unique:the_parents,email,' . $this->parent_id,
            'password' => 'required|min:6',
            'father_job' => 'required',
            'father_name' => 'required',
            'father_job_en' => 'required',
            'father_address' => 'required',
            'father_name_en' => 'required',
            'religion_father_id' => 'required',
            'blood_type_father_id' => 'required',
            'nationality_father_id' => 'required',
            'father_phone_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'father_national_id' => 'required|string|max:10|min:10|regex:/[0-9]{9}/|unique:the_parents,father_national_id,' . $this->parent_id,
            'father_passport_id' => 'required|unique:the_parents,father_passport_id,' . $this->parent_id,
        ];


        if ($this->editMode) {
            $this->skipUniqueValidations($rules);
        }

        $this->validate($rules);
        $this->currentStep = 2;
    }

    public function secondStepSubmit()
    {

        $rules = [
            'mother_job' => 'required',
            'mother_name' => 'required',
            'mother_job_en' => 'required',
            'mother_address' => 'required',
            'mother_name_en' => 'required',
            'religion_mother_id' => 'required',
            'blood_type_mother_id' => 'required',
            'nationality_mother_id' => 'required',
            'mother_phone_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'mother_national_id' => 'required|string|max:10|min:10|regex:/[0-9]{9}/|unique:the_parents,mother_national_id,' . $this->parent_id,
            'mother_passport_id' => 'required|unique:the_parents,mother_passport_id,' . $this->parent_id,
        ];

        if ($this->editMode) {
            $this->skipUniqueValidations($rules);
        }

        $this->validate($rules);

        $this->currentStep = 3;
    }


    //back
    public function back($step)
    {
        $this->currentStep = $step;
    }


    public function submitForm()
    {

        try {

            if ($this->editMode) {
                $the_parents = TheParents::find($this->parent_id);
                $message = trans('messages_trans.update');
            } else {
                $the_parents = new TheParents();
                $the_parents->password = Hash::make($this->password);
                $message = trans('messages_trans.success');
            }

            //father_infos
            $the_parents->email = $this->email;

            $the_parents->father_name = ['en' => $this->father_name_en, 'ar' => $this->father_name];
            $the_parents->father_job = ['en' =>  $this->father_job_en, 'ar' =>  $this->father_job];
            $the_parents->father_national_id = $this->father_national_id;
            $the_parents->father_passport_id = $this->father_passport_id;
            $the_parents->father_phone_number = $this->father_phone_number;
            $the_parents->nationality_father_id = $this->nationality_father_id;
            $the_parents->blood_type_father_id = $this->blood_type_father_id;
            $the_parents->religion_father_id = $this->religion_father_id;
            $the_parents->father_address = $this->father_address;

            //mother_infos
            $the_parents->mother_name = ['en' => $this->mother_name_en, 'ar' => $this->mother_name];
            $the_parents->mother_job = ['en' =>  $this->mother_job_en, 'ar' =>  $this->mother_job];
            $the_parents->mother_national_id = $this->mother_national_id;
            $the_parents->mother_passport_id = $this->mother_passport_id;
            $the_parents->mother_phone_number = $this->mother_phone_number;
            $the_parents->nationality_mother_id = $this->nationality_mother_id;
            $the_parents->blood_type_mother_id = $this->blood_type_mother_id;
            $the_parents->religion_mother_id = $this->religion_mother_id;
            $the_parents->mother_address = $this->mother_address;

            $the_parents->save();

            // $this->upload_Parents_Attachment();


            if (!empty($this->photos)) {
                $directory =  $this->getDirectory($the_parents);
                $this->uploadAttachments($this->photos, $the_parents, $directory);
            }



            $this->successMessage = $message;
            $this->clearForm();
            $this->currentStep = 1;
        } catch (\Exception $e) {
            $this->catchError = $e->getMessage();
        }
    }

    public function mount($editMode = false, $parent_id = null)
    {
        $this->editMode = $editMode;
        $this->parent_id = $parent_id;

        if ($this->editMode && $this->parent_id) {
            $this->editParent($this->parent_id);
            $this->showTable = false;
            $this->currentStep = 1;
        }
    }

    public function editParent($id)
    {
        $parent = TheParents::find($id);

        $this->parent_id = $parent->id;
        $this->email = $parent->email;
        $this->password = '';
        $this->father_name = $parent->getTranslation('father_name', 'ar');
        $this->father_name_en = $parent->getTranslation('father_name', 'en');
        $this->father_national_id = $parent->father_national_id;
        $this->father_passport_id = $parent->father_passport_id;
        $this->father_phone_number = $parent->father_phone_number;
        $this->father_job = $parent->getTranslation('father_job', 'ar');
        $this->father_job_en = $parent->getTranslation('father_job', 'en');
        $this->father_address = $parent->father_address;
        $this->nationality_father_id = $parent->nationality_father_id;
        $this->blood_type_father_id = $parent->blood_type_father_id;
        $this->religion_father_id = $parent->religion_father_id;

        $this->mother_name = $parent->getTranslation('mother_name', 'ar');
        $this->mother_name_en = $parent->getTranslation('mother_name', 'en');
        $this->mother_national_id = $parent->mother_national_id;
        $this->mother_passport_id = $parent->mother_passport_id;
        $this->mother_phone_number = $parent->mother_phone_number;
        $this->mother_job = $parent->getTranslation('mother_job', 'ar');
        $this->mother_job_en = $parent->getTranslation('mother_job', 'en');
        $this->mother_address = $parent->mother_address;
        $this->nationality_mother_id = $parent->nationality_mother_id;
        $this->blood_type_mother_id = $parent->blood_type_mother_id;
        $this->religion_mother_id = $parent->religion_mother_id;
        if (isset($this->photos)) {
            $this->photos = $parent->parents()->file_name;
        }
    }

    public function clearForm()
    {

        //father_infos
        $this->email = '';
        $this->password = '';
        $this->father_name = '';
        $this->father_national_id = '';
        $this->father_passport_id = '';
        $this->father_phone_number = '';
        $this->father_job = '';
        $this->father_address = '';
        $this->nationality_father_id = '';
        $this->blood_type_father_id = '';
        $this->religion_father_id = '';

        //mother_infos

        $this->mother_name = '';
        $this->mother_national_id = '';
        $this->mother_passport_id = '';
        $this->religion_mother_id = '';
        $this->mother_phone_number = '';
        $this->mother_job = '';
        $this->mother_address = '';
        $this->nationality_mother_id = '';
        $this->blood_type_mother_id = '';

        //clear 
        $this->photos = null;
    }




    public function delete($id)
    {
        DB::beginTransaction();

        try {
            $deleted_parent = TheParents::findOrfail($id);

            // Delete all attachments using trait
            $this->deleteModelAttachments($deleted_parent);

            
            $deleted_parent->delete();

            DB::commit();

            $this->showTable = true;
            toastr()->error(trans('messages_trans.delete'));
            return redirect()->route('add_parent');
        } catch (\Exception $e) {
            DB::rollBack();
            toastr()->error(trans('messages_trans.delete_error'));
            return redirect()->back();
        }
    }
}