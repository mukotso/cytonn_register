<?php

namespace App\Interfaces;

interface EventRepositoryInterface
{
    public function getAllEvents();
    public function getEventById($event);
    public function deleteEvent($eventId);
    public function createEvent(array $eventDetails);
    public function updateEvent($event, $newDetails);
}
