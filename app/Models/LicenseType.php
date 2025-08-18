<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LicenseType extends Model
{
    use HasFactory;

    protected $fillable = [
        'license_type_name',
        'license_type_description'
    ];

    public function devices()
    {
        return $this->hasMany(Device::class);
    }
}
