<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class tasks extends Model
{
    protected $table = 'tasks';
    protected $fillable = ['name', 'category', 'priority', 'status', 'assigned_to', 'description', 'created_at', 'updated_at', 'deleted_at', 'list_id'];

    public function lists()
    {
        return $this->belongsTo(lists::class, 'list_id');
    }


}
