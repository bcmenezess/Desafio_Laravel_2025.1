<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{

    use Notifiable;
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

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
