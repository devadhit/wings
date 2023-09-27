<?php

namespace App\Http\Controllers;

use App\Models\TransactionDetail;
use App\Models\TransactionHeader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $cart = session()->get('cart', []);
            $total = 0;

            foreach ($cart as $product_code => $cartItem) {
                $total += $cartItem['price'] * $cartItem['quantity'];
            }

            $latestDocumentCode = TransactionHeader::max('document_code');
            $latestDocumentNumber = TransactionHeader::max('document_number');

            $nextDocumentCode = $this->generateNextCode($latestDocumentCode);
            $nextDocumentNumber = $this->generateNextNumber($latestDocumentNumber);

            $transactionHeader = TransactionHeader::create([
                'document_code' => $nextDocumentCode,
                'document_number' => $nextDocumentNumber,
                'total' => $total,
                'date' => now(),
                'user_id' => $user->id,
            ]);

            foreach ($cart as $product_code => $cartItem) {
                $subtotal = $cartItem['price'] * $cartItem['quantity'];
                TransactionDetail::create([
                    'quantity' => $cartItem['quantity'],
                    'sub_total' => $subtotal,
                    'document_code' => $nextDocumentCode,
                    'product_code' => $product_code,
                ]);
            }

            session()->forget('cart');

            $transactionDetails = TransactionDetail::where('document_code', $nextDocumentCode)->get();

            return view('products.transaction', compact('transactionHeader', 'transactionDetails'));
        } else {
            return redirect()->route('login');
        }
    }

    private function generateNextCode($latestCode)
    {
        if (!$latestCode) {
            return 'T01';
        }

        $lastNumber = intval(substr($latestCode, 1));
        $nextNumber = $lastNumber + 1;
        $nextCode = 'T' . str_pad($nextNumber, 2, '0', STR_PAD_LEFT);

        return $nextCode;
    }

    private function generateNextNumber($latestNumber)
    {
        if (!$latestNumber) {
            return 'DOC - 01';
        }

        $lastNumber = intval(substr($latestNumber, 6));
        $nextNumber = $lastNumber + 1;
        $nextNumberFormatted = str_pad($nextNumber, 2, '0', STR_PAD_LEFT);

        return 'DOC - ' . $nextNumberFormatted;
    }
}
