<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'product';
    protected $primaryKey = 'product_code';
    protected $keyType = 'string';

    protected $fillable = [
        'product_name',
        'product_image',
        'price',
        'currency',
        'discount',
        'dimension',
        'unit',
    ];

}
