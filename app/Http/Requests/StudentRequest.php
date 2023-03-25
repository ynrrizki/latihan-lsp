<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            "name" => 'required',
            "email" => 'required|unique:users',
            "username" => 'required|unique:users',
            "password" => 'required',
            "nisn" => 'required|unique:students',
            "nis" => 'required|unique:students',
            "std_class_id" => 'required',
            "address" => 'required',
            "phone" => 'required',
        ];
    }
}
