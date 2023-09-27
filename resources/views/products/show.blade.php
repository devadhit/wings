@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if ($product)
            <div class="col-md-8">
                <div class="card">
                    <h2 class="card-header text-center">Product Detail</h2>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="{{ asset('product_images/' . $product->product_image) }}" class="card-img-top" alt="{{ $product->product_name }}" style="width: 100%; max-height: 400px; object-fit: cover;">
                            </div>
                            <div class="col-md-8">
                                <h2 class="card-title">{{ $product->product_name }}</h2>
                                <hr>
                                @if ($product->discount > 0)
                                    <p class="card-text">Price: <del>Rp. {{ number_format($product->price, 0) }}</del></p>
                                    <p class="card-text">Discounted Price: Rp. {{ $product->price - ($product->price * ($product->discount / 100)) }}</p>
                                @else
                                    <p class="card-text">Price: Rp. {{ $product->price }}</p>
                                @endif
                                <p class="card-text">Dimension: {{ $product->dimension }}</p>
                                <p class="card-text">Price Unit: {{ $product->unit }}</p>
                                <hr>
                                <div class="d-flex justify-content-between align-items-center">
                                    <form action="{{ route('cart.addToCart', ['product_code' => $product->product_code]) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-success">Add to Cart</button>
                                    </form>
                                    <a href="{{ route('product.index') }}" class="btn btn-secondary">Back to List</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <p>Product not found.</p>
        @endif
    </div>
</div>
@endsection
