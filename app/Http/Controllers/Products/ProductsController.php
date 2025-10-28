<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Models\Product\Cart;
use App\Models\Product\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ProductsController extends Controller
{
    public function singleProduct($id)
    {
        $product = Product::find($id);

        $relatedProducts = Product::where('type', $product->type)->where('id', '!=', $product->id)->take(4)
            ->orderBy('id', 'desc')
            ->get();

        // checking for products in the cart

        $checkingInCart = Cart::where('pro_id', $id)
            ->where('user_id', Auth::user()->id)->count();

        return view('products.productSingle', compact('product', 'relatedProducts', 'checkingInCart'));
    }

    public function addCart(Request $request, $id)
    {

        $addCart = Cart::create([
            'pro_id' => $request->pro_id,
            'name' => $request->name,
            'price' => $request->price,
            'image' => $request->image,
            "user_id" => Auth::user()->id,
        ]);

        return Redirect::route('product.single', $id)->with(['success' => "product added to cart successfully"]);


    }
}
