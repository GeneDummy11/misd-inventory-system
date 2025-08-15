<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class DeviceTypeController extends Controller
{
    public function index()
    {
        return Inertia::render('device_types/Index');
    }
}
