<?php

namespace App\Repositories;
use App\Interfaces\EventTeamMemberRepositoryInterface;
use App\Models\EventTeamMember;

class EventTeamMemberRepository implements EventTeamMemberRepositoryInterface
{
    public function deleteMember($teamMember)
    {

        return EventTeamMember::destroy($teamMember);
    }

}
