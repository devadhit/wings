<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }


    public function show($product_code)
    {
        $product = Product::find($product_code);

        if (!$product) {
            abort(404); // Tampilkan halaman 404 jika produk tidak ditemukan
        }
        return view('products.show', compact('product'));
    }

}
