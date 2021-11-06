<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        return view('inventory.dashboard.index');
    }
}
