<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable=[
        'name'
    ];

    public function events(){
        return $this->belongsToMany(Event::class, 'department_events',
            'department_id', 'event_id');
    }

}
