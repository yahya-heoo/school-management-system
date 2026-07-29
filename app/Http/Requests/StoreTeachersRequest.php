<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTeachersRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {   
        $teacherId = $this->route('teacher');
        return [
            'teacher_name_ar'=>'required|string',
            'teacher_name_en'=>'required|string',
            'address'=>'required',
            'email' => 'required|email|unique:teachers,email,' . $teacherId,
            'password' => $teacherId ? 'nullable|min:6' : 'required|min:6', 
            'joining_date'=>'required|date',
            'gender_id'=>'required|exists:genders,id',
            'specialization_id'=>'required|exists:specializations,id',
        ];
    }
}
