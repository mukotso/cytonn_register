<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table='event_activities';
    protected $fillable=[
        'event_id',
        'description',
        'status',
    ];
}
