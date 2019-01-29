<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class UserStoreRequest extends FormRequest
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
            'email' => 'required|unique:users|email',
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
