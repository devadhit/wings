<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;

    protected $table = 'transaction_detail';
    protected $primaryKey = 'id';

    protected $fillable = ['quantity', 'sub_total', 'document_code', 'product_code'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_code', 'product_code');
    }
}
