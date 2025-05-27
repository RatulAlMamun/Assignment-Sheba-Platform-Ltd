<?php

namespace App\Http\Requests;

use App\Http\Controllers\BaseController;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreBookingRequest extends FormRequest
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
            'customer_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'service_id'    => 'required|exists:services,id',
            'schedule_time' => 'required|date|after:now',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $response = (new BaseController)->sendErrorJson(
            'Validation Error',
            $validator->errors(),
            422
        );
        throw new HttpResponseException($response);
    }
}
