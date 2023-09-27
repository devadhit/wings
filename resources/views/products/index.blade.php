@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @foreach($products as $product)
        <div class="col-md-4">
            <div class="card mb-4">
                <img src="{{ asset('product_images/' . $product->product_image) }}" class="card-img-top" alt="{{ $product->product_name }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->product_name }}</h5>
                    <hr>
                    @if ($product->discount > 0)
                        <p class="card-text">Price: <del>Rp. {{ number_format($product->price, 0) }}</del></p>
                        <p class="card-text">Discounted Price: Rp. {{ $product->price - ($product->price * ($product->discount / 100)) }}</p>
                    @else
                        <p class="card-text">Price: Rp. {{ number_format($product->price, 0) }}</p>
                    @endif
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('product.show', ['product_code' => $product->product_code]) }}" class="btn btn-primary">View Details</a>
                        <form action="{{ route('cart.addToCart', ['product_code' => $product->product_code]) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success">Add to Cart</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
