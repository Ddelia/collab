<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tasks';

    protected $fillable = [
        'resp_id', 'owner_id', 'title', 'description', 'deadline', 'priority_code'
    ];

    public function resp()
    {
        return $this->belongsTo('App\User' , 'resp_id');
    }

    public function owner()
    {
        return $this->belongsTo('App\User' , 'owner_id');
    }

    public function priority()
    {
        return $this->belongsTo('App\Priority', 'priority_code');
    }
}
