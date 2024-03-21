<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePropertyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    // public function authorize(): bool
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'item_name' => 'required',
            'property_no' => 'required|unique:properties',
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'description' => 'string|required',
            'serial_no' => 'required|unique:properties',
            'measurement_unit' => 'required',
            'unit_value' => 'numeric|required',
            'acquisition_id' => 'required',
            'received_from' => 'required',
            'office_id' => 'required',
            'assigned_to' => 'required',
            'date_acquired' => 'date|required',
            'status' => 'in:Serviceable,Unserviceable|required',
            'document' => 'required|mimes:pdf',
            'photo' => 'required|mimes:jpeg,jpg,png|max:5120',
        ];
    }

    public function messages()
    {
        return [
            'item_name.required' => 'The property name field is required.',
            'property_no.required' => 'The property number field is required.',
            'property_no.unique' => 'The property number field has already been taken.',
            'category_id.required' => 'The category field is required.',
            'subcategory_id.required' => 'The subcategory field is required.',
            'serial_no.required' => 'The serial number field is required.',
            'serial_no.unique' => 'The serial number field has already been taken.',
            'acquisition_id.required' => 'The acquisition field is required.',
            'office_id.required' => 'The office field is required.',
            // 'received_from.required' => 'The received from field is required.',
        ];
    }
}
