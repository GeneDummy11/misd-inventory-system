<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class UserRoleController extends Controller
{
    public function index()
    {
        return Inertia::render('end_users/user_roles/Index');
    }
}
