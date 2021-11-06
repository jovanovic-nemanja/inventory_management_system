<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Product;
use App\Requests;
use App\RoleUser;
use App\User;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::count();
        $seller = RoleUser::where('role_id', 2)->count();
        $buyer = RoleUser::where('role_id', 3)->count();
        $product = Product::where('status', 2)->count();
        $request = Requests::count();

        return view('admin.dashboard.index', ['users' => $users, 'seller' => $seller, 'buyer' => $buyer, 'product' => $product, 'request' => $request]);
    }
}