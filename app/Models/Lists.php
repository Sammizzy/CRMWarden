<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lists extends Model
{
    protected $table = 'lists';
    protected $fillable = ['name', 'category'];


    //will implement the below when lists are set up
//    public function tasks()
//    {
//        return $this->HasMany(task::class);
//    }


}
