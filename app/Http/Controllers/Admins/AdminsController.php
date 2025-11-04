<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Admin\Admin;
use App\Models\Product\Booking;
use App\Models\Product\Order;
use App\Models\Product\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
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

        return Redirect::route('all.admins')->with(['error' => "Admin not created successfully"]);
    }

    public function displayAllOrders() {
        $allOrders = Order::select()->orderBy('id', 'desc')->get();

        return view('admins.allOrders', compact('allOrders'));
    }

    public function editOrder($id) {
        $order = Order::find($id);
        return view('admins.editOrder', compact('order'));
    }

    public function updateOrder(Request $request, $id) {
        $order = Order::find($id);

        if ($order) {
            $order->update($request->all());
            return Redirect::route('all.orders')->with(['updated' => "Order updated successfully"]);
        }
        return Redirect::route('all.orders')->with(['error' => "Order not updated successfully"]);
    }

    public function deleteOrder($id) {
        $order = Order::find($id);

        if ($order) {
            $order->delete();
            return Redirect::route('all.orders')->with(['deleted' => "Order deleted successfully"]);
        }

        return Redirect::route('all.orders')->with(['error' => "Order not deleted successfully"]);
    }

    public function displayAllProducts() {
        $products = Product::select()->orderBy('id', 'desc')->get();
        return view('admins.allProducts', compact('products'));
    }

    public function createProduct() {
        return view('admins.create_product');
    }

    public function storeProduct(Request $request) {
        Request()->validate([]);

        $destinationPath = "assets/images";
        $myimage = $request->image->getClientOriginalName();
        $request->image->move(public_path($destinationPath), $myimage);

        Product::Create([
            "name" => $request->name,
            "price" => $request->price,
            "image" => $myimage,
            "description" => $request->description,
            "type" => $request->type,
        ]);

        return Redirect::route('all.products')->with(['created' => "Product created successfully"]);
    }

    public function deleteProduct($id) {
        $product = Product::find($id);

        if ($product) {
            if (File::exists(public_path('assets/images/' . $product->image))) {
                File::delete(public_path('assets/images/' . $product->image));
            }
            $product->delete();
            return Redirect::route('all.products')->with(['deleted' => "Product deleted successfully"]);
        }

        return Redirect::route('all.products')->with(['error' => "Product not deleted successfully"]);
    }

    public function displayAllBookings() {
        $bookings = Booking::select()->orderBy('id', 'desc')->get();
        return view('admins.all_bookings', compact('bookings'));

    }

    public function editBooking($id) {
        $booking = Booking::find($id);

        if ($booking) {
            return view('admins.edit_booking', compact('booking'));
        }

        return Redirect::route('all.bookings')->with(['error' => "Booking not found"]);
    }

    public function updateBooking(Request $request, $id) {
        $booking = Booking::find($id);
        if ($booking) {
            $booking->update($request->all());
            return Redirect::route('all.bookings')->with(['updated' => "Booking updated successfully"]);
        }
        return Redirect::route('all.bookings')->with(['error' => "Booking not updated successfully"]);
    }

    public function deleteBooking($id) {
        $booking = Booking::find($id);

        if ($booking) {
            $booking->delete();
            return Redirect::route('all.bookings')->with(['deleted' => "Booking deleted successfully"]);
        }

        return Redirect::route('all.bookings')->with(['error' => "Booking not deleted successfully"]);
    }
}
