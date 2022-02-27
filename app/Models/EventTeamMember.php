<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventTeamMember extends Model
{
    protected $fillable=[
        'event_id',
        'user_id',
        'is_owner',
        'designation'

    ];
}
