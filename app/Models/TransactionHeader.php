<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionHeader extends Model
{
    use HasFactory;
    protected $table = 'transaction_header';
    protected $primaryKey = 'document_code';
    protected $keyType = 'string';

    protected $fillable = ['document_code','document_number', 'total', 'date', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class, 'document_code', 'document_code');
    }

}
