<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tasks extends Model
{
    protected $table = 'tasks';
    protected $fillable = ['name', 'category', 'priority', 'status', 'assigned_to'];

    public function lists()
    {
        return $this->belongsTo(lists::class, 'list_id');
    }


}
