<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $fillable = [
        'device_name',
        'device_model',
        'device_description',
        'device_serial_number',
        'device_property_number',
        'device_delivery_date',
        'device_aquisition_cost',
        'device_remarks',
        'device_deployment_date',
        'end_user_id',
        'device_type_id',
        'brand_id',
        'status_id',
        'supplier_id',
        'arrangement_id'
    ];

    public function end_user()
    {
        return $this->belongsTo(EndUser::class);
    }

    public function device_type()
    {
        return $this->belongsTo(DeviceType::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function arrangement()
    {
        return $this->belongsTo(Arrangement::class);
    }
}
