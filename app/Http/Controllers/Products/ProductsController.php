<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Models\Product\Booking;
use App\Models\Product\Cart;
use App\Models\Product\Order;
use App\Models\Product\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ProductsController extends Controller {
    public function singleProduct($id) {
        $product = Product::find($id);

        $relatedProducts = Product::where('type', $product->type)->where('id', '!=', $product->id)->take(4)
            ->orderBy('id', 'desc')
            ->get();

        // checking for products in the cart

        $checkingInCart = Cart::where('pro_id', $id)
            ->where('user_id', Auth::user()->id)->count();

        return view('products.productSingle', compact('product', 'relatedProducts', 'checkingInCart'));
    }

    public function addCart(Request $request, $id) {

        $addCart = Cart::create([
            'pro_id' => $request->pro_id,
            'name' => $request->name,
            'price' => $request->price,
            'image' => $request->image,
            'description' => $request->description,
            "user_id" => Auth::user()->id,
        ]);

        return Redirect::route('product.single', $id)->with(['success' => "product added to cart successfully"]);
    }

    public function cart() {
        $products = Cart::where('user_id', Auth::user()->id);

        $totalPrice = $products->sum('price');

        $cartProducts = $products->orderBy('id', 'desc')->get();

        return view('products.cart', compact('cartProducts', 'totalPrice'));
    }

    public function deleteProductCart($id) {

        $deleteProductCart = Cart::where('pro_id', $id)->where('user_id', Auth::user()->id);

        if ($deleteProductCart) {
            $deleteProductCart->delete();
            return Redirect::route('cart')->with(['delete' => "product deleted from cart successfully"]);
        } else {
            return Redirect::route('cart')->with(['error' => "product not deleted from cart successfully"]);
        }
    }

    public function prepareCheckout(Request $request) {
        $value = $request->price;

        $price = Session::put('price', $value);

        $newPrice = Session::get($price);

        if ($newPrice > 0) {
            return Redirect::route('checkout');
        }
    }

    public function checkout() {
        return view('products.checkout');
    }

    public function storeCheckout(Request $request) {
        $checkout = Order::create($request->all());

        if ($checkout) {
            return Redirect::route('products.pay');
        }
    }

    public function payWithPaypal() {

        return view('products.pay');

    }

    public function success() {
        $deleteItems = Cart::where('user_id', Auth::user()->id);

        if ($deleteItems) {

            $deleteItems->delete();
            Session::forget('price');
            return view('products.success');
        }

    }

    public function BookTables(Request $request) {
        if ($request->date > date('n/j/Y')) {
            $bookTables = Booking::create($request->all());
            return Redirect::route('home')->with(['booking' => "you booked a table successfully"]);
        } else {
            return Redirect::route('home')->with(['date' => "invalide date, choose a date in the future"]);
        }

    }
}
