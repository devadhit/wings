@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Order Summary</h1>
    @if ($transactionHeader)
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Transaction Details</h2>
                <p><strong>Document Number:</strong> {{ $transactionHeader->document_number }}</p>
                <p><strong>Date:</strong> {{ $transactionHeader->date }}</p>
                <p><strong>Total:</strong> Rp. {{ $transactionHeader->total }}</p>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-body">
                <h2 class="card-title">Ordered Products</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactionDetails as $transactionDetail)
                            <tr>
                                <td>{{ $transactionDetail->product->product_name }}</td>
                                <td>{{ $transactionDetail->quantity }}</td>
                                <td>Rp. {{ number_format($transactionDetail->sub_total, 0) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <p>Transaction not found.</p>
    @endif
</div>
@endsection
