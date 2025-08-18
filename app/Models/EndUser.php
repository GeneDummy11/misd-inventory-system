<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EndUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'end_user_name',
    ];

    public function device()
    {
        return $this->hasMany(Device::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function division()
    {
        return $this->belongsTo(Division::class);
    }
}
