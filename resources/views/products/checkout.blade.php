@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Shopping Cart</h1>
    @if (count($cart) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart as $product_code => $cartItem)
                    <tr>
                        <td>{{ $cartItem['product_name'] }}</td>
                        <td>Rp. {{ number_format($cartItem['price'], 0) }}</td>
                        <td>{{ $cartItem['quantity'] }}</td>
                        <td>Rp. {{ number_format($cartItem['price'] * $cartItem['quantity'], 0) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="text-center">
            <p class="fs-5">Total: Rp. {{ number_format($total, 0) }}</p>
            <form action="{{ route('checkout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary btn-lg">Checkout</button>
            </form>
        </div>
    @else
        <p>Your cart is empty.</p>
    @endif
</div>
@endsection
