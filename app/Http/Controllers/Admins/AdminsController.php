<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Admin\Admin;
use App\Models\Product\Booking;
use App\Models\Product\Order;
use App\Models\Product\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

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
        $productsCount = Product::select()->count();
        $ordersCount = Order::select()->count();
        $bookingsCount = Booking::select()->count();
        $adminsCount = Admin::select()->count();

        return view('admins.index', compact('productsCount', 'ordersCount', 'bookingsCount', 'adminsCount'));
    }

    public function displayAllAdmins() {
        $admins = Admin::select()->orderBy('id', 'desc')->get();
        return view('admins.allAdmins', compact('admins'));
    }

    public function createAdmins() {

        return view('admins.create_admins');

    }

    public function storeAdmins(Request $request) {
        Request()->validate([
            "name" => "required|max:40",
            "email" => "required|email|max:40|unique:admins",
            "password" => "required|max:40",
        ]);

        $storeAdmins = Admin::Create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
        ]);

        if ($storeAdmins) {
            return Redirect::route('all.admins')->with(['success' => "Admin created successfully"]);
        }

    }

    public function displayAllOrders() {
        $allOrders = Order::select()->orderBy('id', 'desc')->get();

        return view('admins.allOrders', compact('allOrders'));
    }

}
