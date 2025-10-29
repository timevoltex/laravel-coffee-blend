<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Product\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller {
    public function displayOrders() {
        $orders = Order::select()->where("user_id", Auth::user()->id)->get();

        return view('users.orders', compact('orders'));
    }
}
