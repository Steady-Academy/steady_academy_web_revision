<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PriceTypeRequest extends FormRequest
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
        if ($this->tipe_harga == "paid" && $this->promo == "true") {
            return [
                'harga_kursus' => 'required|number|max:8',
                'promo' => 'required',
                'diskon' => 'required|integer|max:2',
                'kode_promo' => 'required|string|max:6',
            ];
        } else if ($this->tipe_harga == "paid") {
            return [
                'harga_kursus' => 'required|number|max:8',
                'promo' => 'required',
            ];
        } else {
            return [
                'harga_kursus' => 'sometimes',
            ];
        }
    }
}
