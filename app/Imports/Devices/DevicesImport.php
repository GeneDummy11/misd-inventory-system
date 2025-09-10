<?php

namespace App\Imports\Devices;

use App\Models\Device;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;

class DevicesImport implements ToModel, WithHeadingRow, WithUpserts, WithValidation, SkipsOnFailure
{
    use SkipsFailures;

    public function model(array $row)
    {
        return new Device([
            'device_name' => $row['device_name'],
            'device_model' => $row['device_model'],
            'device_description' => $row['device_description'],
            'device_serial_number' => $row['device_serial_number'],
            'device_property_number' => $row['device_property_number'],
            'device_delivery_date' => $this->convertDate($row['device_delivery_date']),
            'device_warranty_expiration_date' => $this->convertDate($row['device_warranty_expiration_date']),
            'device_acquisition_cost' => $row['device_acquisition_cost'],
            'device_remarks' => $row['device_remarks'],
            'device_deployment_date' => $this->convertDate($row['device_deployment_date']),
            'end_user_id' => $row['end_user_id'],
            'device_type_id' => $row['device_type_id'],
            'brand_id' => $row['brand_id'],
            'status_id' => $row['status_id'],
            'supplier_id' => $row['supplier_id'],
            'arrangement_id' => $row['arrangement_id'],
        ]);
    }

    public function uniqueBy()
    {
        return 'device_serial_number'; // or use 'device_property_number' if preferred
    }

    public function rules(): array
    {
        return [
            '*.device_name' => 'required',
            '*.device_model' => 'required',
            '*.device_serial_number' => 'required|unique:devices,device_serial_number',
            '*.device_property_number' => 'required|unique:devices,device_property_number',
            '*.device_delivery_date' => 'required|date',
            '*.device_warranty_expiration_date' => 'required|date',
            '*.device_acquisition_cost' => 'required|numeric',
            '*.end_user_id' => 'required|exists:end_users,id',
            '*.device_type_id' => 'required|exists:device_types,id',
            '*.brand_id' => 'required|exists:brands,id',
            '*.status_id' => 'required|exists:statuses,id',
            '*.supplier_id' => 'required|exists:suppliers,id',
            '*.arrangement_id' => 'required|exists:arrangements,id',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'device_name.required' => 'Device name is required.',
            'device_model.required' => 'Device model is required.',
            'device_serial_number.required' => 'Device serial number is required.',
            'device_serial_number.unique' => 'Duplicate serial number found.',
            'device_property_number.required' => 'Device property number is required.',
            'device_property_number.unique' => 'Duplicate property number found.',
            'device_delivery_date.required' => 'Device delivery date is required.',
            'device_delivery_date.date' => 'Delivery date must be a valid date (Y-m-d).',
            'device_warranty_expiration_date.required' => 'Warranty expiration date is required.',
            'device_warranty_expiration_date.date' => 'Warranty expiration date must be a valid date (Y-m-d).',
            'device_acquisition_cost.required' => 'Acquisition cost is required.',
            'device_acquisition_cost.numeric' => 'Acquisition cost must be a number.',
            'end_user_id.required' => 'End user ID is required.',
            'end_user_id.exists' => 'End user ID must exist.',
            'device_type_id.required' => 'Device type ID is required.',
            'device_type_id.exists' => 'Device type ID must exist.',
            'brand_id.required' => 'Brand ID is required.',
            'brand_id.exists' => 'Brand ID must exist.',
            'status_id.required' => 'Status ID is required.',
            'status_id.exists' => 'Status ID must exist.',
            'supplier_id.required' => 'Supplier ID is required.',
            'supplier_id.exists' => 'Supplier ID must exist.',
            'arrangement_id.required' => 'Arrangement ID is required.',
            'arrangement_id.exists' => 'Arrangement ID must exist.',
        ];
    }

    private function convertDate(?string $date): ?string
    {
        if (!$date) return null;

        foreach (['m/d/Y', 'n/j/Y', 'Y-m-d'] as $format) {
            try {
                return Carbon::createFromFormat($format, $date)->format('Y-m-d');
            } catch (\Exception $e) {
                continue;
            }
        }

        return null;
    }
}
