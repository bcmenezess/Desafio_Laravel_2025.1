<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'address',
        'telephone',
        'date_birth',
        'cpf',
        'admin_id',
        'photo'
    ];
    /** @use HasFactory<\Database\Factories\AdminFactory> */
    use HasFactory;
}
