<?php

namespace App\Http\Requests\Devices;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDeviceStatusRequest extends FormRequest
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
            'device_remarks' => 'nullable|string|max:1000',
            'device_deployment_date' => 'required|date',
            'end_user_id' => 'required|exists:end_users,id',
            'status_id' => 'required|exists:statuses,id',
        ];
    }

    // When validating a request, Laravel uses the input field names in error messages.
    // The attributes() method allows you to override these names with more descriptive labels.
    public function attributes()
    {
        return [
            'end_user_id' => 'end-user',
            'status_id' => 'deployment status',
        ];
    }
}
