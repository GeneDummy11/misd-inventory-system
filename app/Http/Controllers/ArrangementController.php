<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class ArrangementController extends Controller
{
    public function index()
    {
        return Inertia::render('arrangements/Index');
    }
}
