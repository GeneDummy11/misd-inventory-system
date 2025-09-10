<?php

namespace App\Http\Controllers;

use App\Http\Requests\Devices\StoreDeviceRequest;
use App\Http\Requests\Devices\UpdateDeviceRequest;
use App\Http\Requests\Devices\UpdateDeviceStatusRequest;
use App\Imports\Devices\DevicesImport;
use App\Models\Arrangement;
use App\Models\Brand;
use App\Models\Device;
use App\Models\DeviceType;
use App\Models\EndUser;
use App\Models\Status;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\HeadingRowImport;

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

        if ($request->filled('warranty_status')) {
            if ($request->warranty_status === 'Expired') {
                $query->whereDate('device_warranty_expiration_date', '<', now());
            }

            if ($request->warranty_status === 'Expiring Soon') {
                $query->whereBetween('device_warranty_expiration_date', [now(), now()->addDays(30)]);
            }

            if ($request->warranty_status === 'Active') {
                $query->whereDate('device_warranty_expiration_date', '>', now()->addDays(30));
            }
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

    public function show(Device $device)
    {
        return Inertia::render('devices/Show', [
            'device' => $device->load(['end_user', 'device_type', 'brand', 'status', 'supplier', 'arrangement']),
        ]);
    }

    public function create()
    {
        $device_types = DeviceType::orderBy('device_type_name')->get();
        $arrangements = Arrangement::orderBy('arrangement_name')->get();
        $statuses = Status::orderBy('status_name')->get();
        $suppliers = Supplier::orderBy('supplier_name')->get();
        $end_users = EndUser::orderBy('end_user_name')->get();
        $brands = Brand::orderBy('brand_name')->get();

        return Inertia::render('devices/Create', [
            'device_types' => $device_types,
            'arrangements' => $arrangements,
            'statuses' => $statuses,
            'suppliers' => $suppliers,
            'end_users' => $end_users,
            'brands' => $brands
        ]);
    }

    public function store(StoreDeviceRequest $request)
    {
        Device::create([
            'device_name' => $request->device_name,
            'device_model' => $request->device_model,
            'device_description' => $request->device_description,
            'device_serial_number' => $request->device_serial_number,
            'device_property_number' => $request->device_property_number,
            'device_acquisition_cost' => $request->device_acquisition_cost,
            'device_remarks' => $request->device_remarks,
            'device_delivery_date' => $request->device_delivery_date,
            'device_warranty_expiration_date' => $request->device_warranty_expiration_date,
            'device_deployment_date' => $request->device_deployment_date,
            'end_user_id' => $request->end_user_id,
            'device_type_id' => $request->device_type_id,
            'brand_id' => $request->brand_id,
            'status_id' => $request->status_id,
            'supplier_id' => $request->supplier_id,
            'arrangement_id' => $request->arrangement_id,
            'created_at' => now(),
            'update_at' => now(),
        ]);

        return redirect()->route('devices.index')->with('success', 'Device created successfully.');
    }

    public function edit(Device $device)
    {
        $device_types = DeviceType::orderBy('device_type_name')->get();
        $arrangements = Arrangement::orderBy('arrangement_name')->get();
        $statuses = Status::orderBy('status_name')->get();
        $suppliers = Supplier::orderBy('supplier_name')->get();
        $end_users = EndUser::orderBy('end_user_name')->get();
        $brands = Brand::orderBy('brand_name')->get();

        return Inertia::render('devices/Edit', [
            'device' => $device->load(['end_user', 'device_type', 'brand', 'status', 'supplier', 'arrangement']),
            'device_types' => $device_types,
            'arrangements' => $arrangements,
            'statuses' => $statuses,
            'suppliers' => $suppliers,
            'end_users' => $end_users,
            'brands' => $brands
        ]);
    }

    public function update(UpdateDeviceRequest $request, Device $device)
    {
        $device->update($request->validated());

        return redirect()->route('devices.index')->with('success', 'Device updated successfully.');
    }

    public function destroy(Device $device)
    {
        $device->delete();

        return redirect()->route('devices.index')->with('success', 'Device deleted successfully.');
    }

    public function updateDeviceStatus(UpdateDeviceStatusRequest $request, Device $device)
    {
        $device->update($request->validated());

        return redirect()->route('devices.index')->with('success', 'Device updated successfully.');
    }

    public function import()
    {
        return Inertia::render('devices/Import');
    }

    public function storeImport(Request $request)
    {
        $expectedHeaders = [
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

        $request->validate([
            'file' => 'required|file',
        ]);

        $file = $request->file('file');

        // dd((new HeadingRowImport)->toArray($file));

        // Get MIME type
        $mimeType = $file->getMimeType(); // e.g., "text/csv"

        // Get original extension
        $extension = $file->getClientOriginalExtension(); // e.g., "csv"

        // Get original name
        $originalName = $file->getClientOriginalName();

        // Extension manual check
        if (!in_array($extension, ['csv', 'xlsx', 'xls'])) {
            return back()->withErrors(['file' => 'Unsupported file type: ' . $extension]);
        }

        $extension = strtolower($file->getClientOriginalExtension());

        $allowedExtensions = ['csv'];

        if (!in_array($extension, $allowedExtensions)) {
            return back()->withErrors(['file' => 'Unsupported file extension: ' . $extension]);
        }

        // Validate headers
        $raw = (new HeadingRowImport)->toArray($file);
        $actualHeaders = array_values($raw[0][0] ?? []);
        $missingHeaders = array_diff($expectedHeaders, $actualHeaders);
        $unexpectedHeaders = array_diff($actualHeaders, $expectedHeaders);

        $suggestions = collect($unexpectedHeaders)->map(function ($header) use ($expectedHeaders) {
            $closest = collect($expectedHeaders)->first(function ($expected) use ($header) {
                return levenshtein($header, $expected) <= 3;
            });

            return $closest ? "$header should be $closest" : $header;
        })->all();

        if ($missingHeaders || $unexpectedHeaders) {
            return back()->withErrors([
                'file' => '<strong>Missing header/s:</strong><br><ul style="list-style-type: disc; padding-left: 20px;">' .
                    implode('', array_map(fn($h) => "<li>$h</li>", $missingHeaders)) .
                    '</ul><br>' .
                    '<strong>Suggestion/s:</strong><br><ul style="list-style-type: disc; padding-left: 20px;">' .
                    implode('', array_map(fn($h) => "<li>$h</li>", $suggestions)) .
                    '</ul>'
            ]);
        }

        $import = new DevicesImport;
        Excel::import($import, $request->file('file'));

        if ($import->failures()->isNotEmpty()) {
            $summary = $import->failures()->map(function ($failure) {
                return "Row {$failure->row()}: " . implode(', ', $failure->errors());
            })->implode('<br>');

            return back()->withErrors([
                'file' => "Import completed with {$import->failures()->count()} error(s):<br>" . $summary
            ]);
        }
    }
}
