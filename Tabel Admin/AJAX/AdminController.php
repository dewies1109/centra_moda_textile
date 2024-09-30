<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\admin;

class AdminController extends Controller
{
    public function index()
    {
        $admins = Admin::latest()->paginate(5);
        return view('admin.list_admin', compact('admins'));
    }
}
