<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function home()
    {
        return view('home');
    }

    public function show_users()
    {
        $users = DB::table('users')
            ->where('role', '=', 0)
            ->orWhere('role', '=', 1)
            ->get();


        return view('admin_pages.users', ['users' => $users]);
    }
}
