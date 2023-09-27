<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $user = Auth::user();

            $salesReport = DB::table('transaction_header')
                ->join('login', 'transaction_header.user_id', '=', 'login.id')
                ->join('transaction_detail', 'transaction_header.document_code', '=', 'transaction_detail.document_code')
                ->join('product', 'transaction_detail.product_code', '=', 'product.product_code')
                ->select(
                    'transaction_header.document_code as transaction',
                    'login.name as user',
                    'transaction_header.total as total',
                    'transaction_header.date as date',
                    'product.product_name as item',
                    'transaction_detail.quantity as quantity'
                )
                ->where('login.id', $user->id)
                ->get();

            return view('products.report', compact('salesReport'));
        } else {
            return redirect()->route('login');
        }
    }
}
