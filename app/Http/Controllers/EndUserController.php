<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class EndUserController extends Controller
{
    public function index()
    {
        return Inertia::render('end_users/end_users/Index');
    }
}
