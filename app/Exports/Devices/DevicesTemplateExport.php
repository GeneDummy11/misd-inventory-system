<?php

namespace App\Exports\Devices;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromArray;

class DevicesTemplateExport implements FromArray, WithHeadings
{
    public function array(): array
    {
        return []; // No data rows, just headers
    }

    public function headings(): array
    {
        return [
            'device_name',
            'device_model',
            'device_description',
            'device_serial_number',
            'device_property_number',
            'device_delivery_date',
            'device_warranty_expiration_date',
            'device_acquisition_cost',
            'device_remarks',
            'device_deployment_date',
            'end_user_id',
            'device_type_id',
            'brand_id',
            'status_id',
            'supplier_id',
            'arrangement_id',
        ];
    }
}
