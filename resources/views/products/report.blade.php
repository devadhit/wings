@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Sales Report</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Transaction</th>
                <th>User</th>
                <th>Total</th>
                <th>Date</th>
                <th>Item</th>
            </tr>
        </thead>
        <tbody>
            @php
                $currentTransaction = null;
            @endphp

            @foreach($salesReport as $report)
                @if ($currentTransaction !== $report->transaction)
                    @php
                        $currentTransaction = $report->transaction;
                    @endphp
                    <tr>
                        <td>{{ $report->transaction }}</td>
                        <td>{{ $report->user }}</td>
                        <td>Rp. {{ $report->total }}</td>
                        <td>{{ $report->date }}</td>
                        <td>
                            {{ $report->item }} ({{ $report->quantity }} pcs)
                        </td>
                    </tr>
                @else
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            {{ $report->item }} ({{ $report->quantity }} pcs)
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</div>
@endsection
