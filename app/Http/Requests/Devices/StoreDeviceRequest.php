<?php

namespace App\Http\Requests\Devices;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreDeviceRequest extends FormRequest
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
            'device_name' => 'required|string|max:255',
            'device_model' => 'required|string|max:255',
            'device_description' => 'nullable|string|max:1000',
            'device_serial_number' => [
                'required',
                'string',
                'max:255',
                Rule::unique('devices', 'device_serial_number'),
            ],
            'device_property_number' => [
                'required',
                'string',
                'max:255',
                Rule::unique('devices', 'device_property_number'),
            ],
            'device_aquisition_cost' => 'required|numeric|min:0',
            'device_remarks' => 'nullable|string|max:1000',
            'device_delivery_date' => 'required|date',
            'device_warranty_expiration_date' => 'required|date',
            'device_deployment_date' => 'required|date',
            'end_user_id' => 'required|exists:end_users,id',
            'device_type_id' => 'required|exists:device_types,id',
            'brand_id' => 'required|exists:brands,id',
            'status_id' => 'required|exists:statuses,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'arrangement_id' => 'required|exists:arrangements,id',
        ];
    }

    // When validating a request, Laravel uses the input field names in error messages.
    // The attributes() method allows you to override these names with more descriptive labels.
    public function attributes()
    {
        return [
            'end_user_id' => 'end-user',
            'device_type_id' => 'type',
            'brand_id' => 'brand',
            'status_id' => 'status',
            'supplier_id' => 'supplier',
            'arrangement_id' => 'arrangement',
        ];
    }
}
