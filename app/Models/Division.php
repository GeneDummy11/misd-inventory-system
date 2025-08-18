<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;

    protected $fillable = [
        'division_name',
        'division_description'
    ];

    public function end_users()
    {
        return $this->hasMany(EndUser::class);
    }

    public function services()
    {
        return $this->belongsTo(Service::class);
    }
}
