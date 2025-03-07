<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'price',
        'quantity',
        'description',
        'category',
        'user_id'
    ];
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;
}
