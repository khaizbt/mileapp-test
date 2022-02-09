<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdatePackageRequest extends FormRequest
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
            "customer_origin" =>"required|exists:customers,_id",
            "customer_destination"  =>"required|exists:customers,_id",
            "transsaction_value" => "required|min:4",
            "location_code" => "required|exists:locations,_id",
            "connote_code" => "required|exists:connotes,_id"
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response_error(null, $validator->errors(), 422));
    }

    public function validationData()
    {
        return $this->json()->all();
    }

    public function attributes()
    {
        return [
            "customer_origin" =>"Customer Pengirim",
            "customer_destination"  =>"Customer Penerima",
            "transsaction_value" => "Biaya Pengiriman",
            "location_code" => "Lokasi",
            "connote_code" => "Connote"
        ];
    }
}
