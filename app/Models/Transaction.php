<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'date',
        'quantity',
        'total_price',
        'buyer_id',
        'product_id'
    ];
    /** @use HasFactory<\Database\Factories\TransactionFactory> */
    use HasFactory;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
