<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'date',
        'quantity',
        'total_price'
    ];
    /** @use HasFactory<\Database\Factories\TransactionFactory> */
    use HasFactory;
}
