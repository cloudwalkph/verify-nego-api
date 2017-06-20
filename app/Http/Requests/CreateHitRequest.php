<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateHitRequest extends FormRequest
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
            'name' => 'required',
            'contact_number' => 'required',
            'address' => 'required',
            'school_name' => 'required',
            'designation' => 'required',
            'location' => 'required',
            'email' => 'required',
        ];
    }

    public function response(array $errors)
    {
        return response()->json($errors, 422);
    }


}
