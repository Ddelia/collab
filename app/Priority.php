<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Priority extends Model
{
    protected $table = 'priorities';

    public function tasks()
    {
        return $this->hasMany('App\Task', 'code');
    }
}
