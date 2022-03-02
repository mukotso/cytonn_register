<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Event extends Model
{
    protected $with=['activities','category','frequency','creator'];
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
//    public function getTeamMembersUserIds(){
//       $teamMembers= $this->teamMembers();
//       $teamMembersUserIds=[];
//       foreach($teamMembers as $member){
//           array_push($teamMembersUserIds,$member->user_id);
//       }
//       return  $teamMembersUserIds;
//    }
    public function teamMembers(){
        return $this->hasMany(EventTeamMember::class,'event_id');
    }

    public function creator(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function frequency(){
        return $this->belongsTo(Frequency::class);
    }
    public function department(){
        return $this->belongsToMany(Department::class, 'department_events',
            'event_id', 'department_id');
    }


}
