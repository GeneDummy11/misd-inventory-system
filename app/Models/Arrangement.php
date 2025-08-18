<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arrangement extends Model
{
    use HasFactory;

    protected $fillable = [
        'arrangement_name',
        'arrangement_description'
    ];

    public function devices()
    {
        return $this->hasMany(Device::class);
    }
}
