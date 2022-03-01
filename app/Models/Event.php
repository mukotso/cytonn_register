<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable=[
        'category-id',
        'frequency_id',
        'name',
        'venue',
        'start_date',
        'event_date',
        'lead_time'
        ];

    public function activities(){
        return $this->hasMany(Activity::class,'event_id');
    }
    public function teamMembers(){
        return $this->hasMany(EventTeamMember::class,'event_id');
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function frequency(){
        return $this->belongsTo(Frequency::class);
    }
}
