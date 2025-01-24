<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Branch;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::all();
        $userCount = $users->count();
        
        return view('dashboard.index', compact('users', 'userCount'));
    }
}
