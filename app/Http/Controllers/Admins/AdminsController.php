<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminsController extends Controller {
    public function viewLogin() {
        return view('admins.login');
    }

    public function checkLogin(Request $request) {
        if (auth()->guard('admin')->attempt(['email' => $request->input("email"), "password" => $request->input("password")])) {
            return redirect()->route("admin.dashboard");

        }
        return redirect()->back()->with(['error' => 'error logged in']);

    }

    public function index() {
        return view('admins.index');
    }
}
