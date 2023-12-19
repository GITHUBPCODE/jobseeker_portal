<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class JobSeekerRequest extends FormRequest
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
        return [
            'name' => ['required', 'regex:/^[a-zA-Z0-9\s]+$/', 'not_regex:/^\d+$/'],
            'email' => 'required|email|unique:users',
            'phone' => ['required', 'regex:/^\+?\d{10,14}$/'],
            'experience' => 'required|numeric',
            'notice_period' => 'required|numeric',
            'skills' => 'required',
            'job_location' => 'required',
            'resume' => 'required|mimes:pdf,doc,docx|max:2048',
            'photo' => 'required|image|max:2048',
        ];
    }
}
