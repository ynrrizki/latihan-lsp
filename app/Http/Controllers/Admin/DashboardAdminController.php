<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StdClass;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    public function index()
    {
        $counts = [
            'admin' => User::where('role', 'ADMIN')->count(),
            'operator' => User::where('role', 'OPERATOR')->count(),
            'class' => StdClass::all()->count(),
        ];
        return view('pages.admin.index', compact('counts'));
    }
}
