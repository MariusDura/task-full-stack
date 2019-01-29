<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class UserUpdateRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:30',
            'username' => 'required',
            'email' => 'required|email',
            'phone' => 'required|string',
            'website' => 'required|string|max:190',
            'address.street' => 'required|string',
            'address.suite' => 'required|string',
            'address.city' => 'required|string',
            'address.zipcode' => 'required|string',
            'address.geo.lat' => 'required|numeric',
            'address.geo.lng' => 'required|numeric',
            'company.name' => 'required|string',
            'company.catch_phrase' => 'required|string',
            'company.bs' => 'required|string'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'address.street.required' => 'The street field is required.',
            'address.suite.required' => 'The suite field is required.',
            'address.city.required' => 'The city field is required.',
            'address.zipcode.required' => 'The zipcode field is required.',
            'address.geo.lat.required' => 'The geo lat field is required.',
            'address.geo.lat.numeric' =>'The geo lat must be a number.',
            'address.geo.lng.required' => 'The geo lng field is required.',
            'address.geo.lng.numeric' =>'The geo lng must be a number.',
            'company.name.required' => 'The name field is required.',
            'company.catch_phrase.required' => 'The catch phrase field is required.',
            'company.bs.required' => 'The bs field is required.'
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    /* uncomment if getting 404 error on validation
    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(response()->json(['errors' => $errors
        ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
    }*/
}
