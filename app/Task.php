<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //'Model for the table tasks table'
    public $table = 'tasks';

    protected $fillable = [
        'description',
    ];

    //function for database change state complete
    public function isCompleted()
    {
        return $this->completed_at !== null;
    }
}
