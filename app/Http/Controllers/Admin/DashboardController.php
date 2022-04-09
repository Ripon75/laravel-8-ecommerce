<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function user()
    {
        $users = User::get();

        return view('admin.user.index', [
            'users' => $users
        ]);
    }
}
