<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    public function index()
    {
        if (Gate::denies('access_dashboard_user')) {
            abort(403, 'Anda tidak memiliki akses ke dashboard ini.');
        }

        return view('dashboard', ['title' => 'Dashboard']);
    }
}
