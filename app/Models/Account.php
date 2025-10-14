<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Account extends Authenticatable
{
    // Use 'registered' for created_at
    const CREATED_AT = 'registered';
    const UPDATED_AT = null; // no updated_at column

    // Table name
    protected $table = 'accounts';

    // Fillable fields
    protected $fillable = [
        'username', 'email', 'password',
    ];

    // Hidden fields
    protected $hidden = [
        'password', 'remember_token',
    ];

    // Use default primary key (id) for authentication
    // DO NOT override getAuthIdentifierName
    // Laravel will use 'id' internally for sessions
}
