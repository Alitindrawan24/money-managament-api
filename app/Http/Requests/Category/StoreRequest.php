<?php

namespace App\Http\Requests\Category;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name" => "required|max:255",
            "type" => "required|in:in,out",
            "status" => "required|in:0,1",
        ];
    }

    public function messages()
    {
        return [
            "required" => ":attribute wajib diisi ygy",
            "type.required" => ":attribute wajib yaa tolong"
        ];
    }

    public function attributes()
    {
        return  [
            "name" => "Nama"
        ];
    }

    public function failedValidation(Validator $validator) {
        throw new HttpResponseException(
            response()->json([
                "status" => "fail",
                "message" => "Validation failed",
                "errors" => $validator->errors()
            ], 422)
        );
    }
}
