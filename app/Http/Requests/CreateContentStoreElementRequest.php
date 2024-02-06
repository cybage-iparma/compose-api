<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Rules\Media;

class CreateContentStoreElementRequest extends FormRequest
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
            'file' => ['required', 'file', new Media],
            'name' => 'nullable|string',
            'description' => 'nullable|string'
        ];        
    }

    /**
     *  Filters to be applied to the input.
     */
    public function filters(): array
    {
        return [
            'file' => 'trim',
            'name' => 'trim',
            'description' => 'trim',
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
            throw new HttpResponseException(response()->json([
                'msg' => $validator->errors()->toArray(),
                'status_code' => 400
            ], 400));
        }
    }
}
