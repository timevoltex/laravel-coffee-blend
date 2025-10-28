<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Models\Product\Product;

class ProductsController extends Controller
{
    public function singleProduct($id) {
        $product = Product::find($id);

        return view('products.productSingle', compact('product'));
    }
}
