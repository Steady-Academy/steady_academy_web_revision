<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePhotoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if (filter_var($this->foto, FILTER_VALIDATE_URL)) {
            return [
                'foto' => 'required',
            ];
        } else {
            return [
                'foto' => 'required|image|mimes:jpg,png,jpeg,svg|max:1024',
            ];
        }
    }
}
