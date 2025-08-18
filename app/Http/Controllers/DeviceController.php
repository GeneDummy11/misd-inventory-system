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
    public function index(Request $request)
    {
        $end_users = EndUser::orderBy('end_user_name')->get();
        $device_types = DeviceType::orderBy('device_type_name')->get();
        $arrangements = Arrangement::orderBy('arrangement_name')->get();
        $statuses = Status::orderBy('status_name')->get();

        $query = Device::with(['end_user', 'device_type', 'brand', 'status', 'supplier', 'arrangement']);

        if ($request->filled('device_type_id')) {
            $query->where('device_type_id', $request->device_type_id);
        }

        if ($request->filled('arrangement_id')) {
            $query->where('arrangement_id', $request->arrangement_id);
        }

        if ($request->filled('status_id')) {
            $query->where('status_id', $request->status_id);
        }

        $devices = $query->latest()->paginate(15);

        return Inertia::render('devices/Index', [
            'devices' => $devices,
            'end_users' => $end_users,
            'device_types' => $device_types,
            'arrangements' => $arrangements,
            'statuses' => $statuses,
            'filters' => $request->only(['device_type_id', 'arrangement_id', 'status_id']),
        ]);
    }

    public function create()
    {
        return Inertia::render('devices/Create');
    }
}
