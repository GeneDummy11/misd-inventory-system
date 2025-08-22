<?php

namespace App\Http\Controllers;

use App\Models\Arrangement;
use App\Models\Device;
use App\Models\DeviceType;
use App\Models\EndUser;
use App\Models\Status;
use App\Models\Supplier;
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

        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('device_name', 'like', "%{$searchTerm}%")
                    ->orWhere('device_model', 'like', "%{$searchTerm}%")
                    ->orWhere('device_description', 'like', "%{$searchTerm}%")
                    ->orWhere('device_serial_number', 'like', "%{$searchTerm}%")
                    ->orWhere('device_property_number', 'like', "%{$searchTerm}%")
                    ->orWhere('device_remarks', 'like', "%{$searchTerm}%")
                    ->orWhereHas('end_user', function ($subQuery) use ($searchTerm) {
                        $subQuery->where('end_user_name', 'like', "%{$searchTerm}%");
                    })
                    ->orWhereHas('device_type', function ($subQuery) use ($searchTerm) {
                        $subQuery->where('device_type_name', 'like', "%{$searchTerm}%");
                    })
                    ->orWhereHas('brand', function ($subQuery) use ($searchTerm) {
                        $subQuery->where('brand_name', 'like', "%{$searchTerm}%");
                    })
                    ->orWhereHas('status', function ($subQuery) use ($searchTerm) {
                        $subQuery->where('status_name', 'like', "%{$searchTerm}%");
                    })
                    ->orWhereHas('supplier', function ($subQuery) use ($searchTerm) {
                        $subQuery->where('supplier_name', 'like', "%{$searchTerm}%");
                    })
                    ->orWhereHas('arrangement', function ($subQuery) use ($searchTerm) {
                        $subQuery->where('arrangement_name', 'like', "%{$searchTerm}%");
                    });
            });
        }

        $devices = $query->latest()->paginate(15);

        return Inertia::render('devices/Index', [
            'devices' => $devices,
            'end_users' => $end_users,
            'device_types' => $device_types,
            'arrangements' => $arrangements,
            'statuses' => $statuses,
            'filters' => $request->only(['device_type_id', 'arrangement_id', 'status_id', 'search']),
        ]);
    }

    public function create()
    {
        $device_types = DeviceType::orderBy('device_type_name')->get();
        $arrangements = Arrangement::orderBy('arrangement_name')->get();
        $statuses = Status::orderBy('status_name')->get();
        $suppliers = Supplier::orderBy('supplier_name')->get();
        $end_users = EndUser::orderBy('end_user_name')->get();

        return Inertia::render('devices/Create', [
            'device_types' => $device_types,
            'arrangements' => $arrangements,
            'statuses' => $statuses,
            'suppliers' => $suppliers,
            'end_users' => $end_users
        ]);
    }
}
