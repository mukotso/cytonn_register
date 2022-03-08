<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventTeamMember extends Model
{
    protected $fillable=[
        'event_id',
        'user_id',
        'designation'

    ];
    protected $table='event_team_members';

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
