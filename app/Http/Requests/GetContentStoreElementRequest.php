<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class GetContentStoreElementRequest extends FormRequest
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
            'limit' => 'nullable|numeric',
            'page' => 'nullable|numeric',
            'filter_name' => 'nullable|string',
            'filter_mimetype' => 'nullable|string',
            'from_date' => 'nullable|date_format:Y-m-d',
            'to_date' => 'nullable|date_format:Y-m-d|after:from_date',
            'sort_order' => 'nullable|in:asc,desc',
            'sort_by' => 'nullable|string'
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
            throw new HttpResponseException(response()->json($validator->errors(), 422));
        }
    }
}
