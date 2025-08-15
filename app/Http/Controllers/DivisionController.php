<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class DivisionController extends Controller
{
    public function index()
    {
        return Inertia::render('end_users/divisions/Index');
    }
}
