<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreMessageTemplateRequest extends FormRequest
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
            'customer_id' => 'required|int',
            'message_category_id' => 'required|int',
            'template_name' => 'required|string|max:255',
            'template_content_json' => 'required|string',
            'template_content_mjml' => 'required|string'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'customer_id.required' => 'A customer id is required',
            'message_category_id.required' => 'A message category id is required',
        ];
    }

    /**
     *  Handle the Failed Validation response.
     *
     * @return response
     */
    protected function failedValidation(Validator $validator)
    {
        if ($validator->fails()) {
            throw new HttpResponseException(
                response()->json([
                    'error' => 'Validation failed',
                    'message' => $validator->errors(),
                ], 422)
            );
        }
    }
}
