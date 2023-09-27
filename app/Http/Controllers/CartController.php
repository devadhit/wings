<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request, $product_code)
    {
        $request->validate([
            'quantity' => 'integer|min:1',
        ]);

        $product = Product::where('product_code', $product_code)->first();

        if (!$product) {
            return back()->with('error', 'Product not found.');
        }

        $quantity = $request->input('quantity', 1);

        $cart = session()->get('cart', []);

        if (array_key_exists($product_code, $cart)) {
            if (!isset($cart[$product_code]['product_name'])) {
                $cart[$product_code]['product_name'] = $product->product_name;
            }
            if (!isset($cart[$product_code]['quantity'])) {
                $cart[$product_code]['quantity'] = 0;
            }
            $cart[$product_code]['product_name'] = $product->product_name;
            $cart[$product_code]['quantity'] += $quantity;
        } else {
            $cart[$product_code] = [
                'product_code' => $product->product_code,
                'product_name' => $product->product_name,
                'price' => $product->discount > 0 ? $product->price - ($product->price * ($product->discount / 100)) : $product->price,
                'quantity' => $quantity,
            ];
        }

        session()->put('cart', $cart);

        return back()->with('success', 'Product added to cart.');
    }



    public function viewCart()
    {
        $cart = session()->get('cart', []);
        $total = 0;

        foreach ($cart as $product) {
            $total += $product['price'] * $product['quantity'];
        }

        return view('products.checkout', compact('cart', 'total'));
    }
}
