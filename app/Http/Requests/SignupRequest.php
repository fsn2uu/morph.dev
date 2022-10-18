<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignupRequest extends FormRequest
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
            'routing_number' => 'required',
            'account_number' => 'required',
            'fname' => 'required',
            'lname' => 'required',
            'city' => 'required',
            'address' => 'required',
            'zip' => 'required',
            'state' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'company_phone' => 'required',
            'id_number' => 'required', //last 4 ssn
            'accepted_terms' => 'required',
            'acknowledged_legality' => 'required',
            'plan' => 'required',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
            'website' => 'required|active_url',
            'logo' => 'required|image|mimes:jpg,png',
            'number' => 'required',
            'exp_month' => 'required',
            'exp_year' => 'required',
            'cvc' => 'required',
            'account_holder' => 'required',
            'dob_day' => 'required',
            'dob_month' => 'required',
            'dob_year' => 'required',
        ];
    }
}
