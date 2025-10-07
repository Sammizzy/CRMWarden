<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Account extends Authenticatable
{
    //update the created_at column name to match the database column
    const CREATED_AT = 'registered';
    //disable updated_at column as it doesnt exist in database
    const UPDATED_AT = null;

    //table name
    protected $table = 'accounts';

    //fields required for registration
    protected $fillable = [
        'username', 'email', 'password',
    ];

    //fields are hidden from the user
    protected $hidden = [
        'password', 'remember_token',
    ];

    //username is used for authentication
    public function getAuthIdentifierName()
{
    return 'username';
}

}
