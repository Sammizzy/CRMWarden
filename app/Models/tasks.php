<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tasks extends Model
{
    protected $table = 'lists';
    protected $fillable = ['name', 'category', 'priority', 'status', 'assigned_to'];
}
