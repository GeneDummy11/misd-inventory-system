<?php

namespace App\Http\Controllers;

use App\Models\Arrangement;
use App\Models\Device;
use App\Models\DeviceType;
use App\Models\EndUser;
use App\Models\Status;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DeviceController extends Controller
{
    public function index()
    {
        $end_users = EndUser::orderBy('end_user_name')->get();
        $device_types = DeviceType::orderBy('device_type_name')->get();
        $arrangements = Arrangement::orderBy('arrangement_name')->get();
        $statuses = Status::orderBy('status_name')->get();
        $devices = Device::with(['end_user', 'device_type', 'brand', 'status', 'supplier', 'arrangement'])
            ->latest()
            ->Paginate(15);

        return Inertia::render('devices/Index', [
            'devices' => $devices,
            'end_users' => $end_users,
            'device_types' => $device_types,
            'arrangements' => $arrangements,
            'statuses' => $statuses,
        ]);
    }

    public function create()
    {
        return Inertia::render('devices/Create');
    }
}
