<?php

namespace App\Interfaces;

interface EventActivityRepositoryInterface
{
    public function deleteActivity($activityId);
    public function completeActivity($activityId);
    public function activityNotHappening($activityId);
}

