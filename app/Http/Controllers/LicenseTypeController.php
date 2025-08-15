<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class LicenseTypeController extends Controller
{
    public function index()
    {
        return Inertia::render('license_types/Index');
    }
}
