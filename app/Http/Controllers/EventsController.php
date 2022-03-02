<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Interfaces\EventRepositoryInterface;
use App\Models\Event;

class EventsController extends Controller
{
    public $eventRepository;

    public function __construct(EventRepositoryInterface $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }


    public function index()
    {
        $events = $this->eventRepository->getAllEvents();
        if(request()->expectsJson()) {
            return response()->json($events, 200);
        }else{
            return  view('events.index', compact('events'));
        }

    }

    public function store(EventRequest $request)
    {
        return $this->eventRepository->createEvent($request->all());
    }

    public function update(EventRequest $request, $event)
    {
        return $this->eventRepository->updateEvent($event, $request->all());
    }

    public function show($event)
    {
       $event= $this->eventRepository->getEventById($event);
            return  view('events.show', compact('event'));
    }

    public function edit($event)
    {
        $event= $this->eventRepository->getEventById($event);
        return  view('events.edit', compact('event'));
    }

    public function destroy(Event $event)
    {
        return $this->eventRepository->deleteEvent($event->id);
    }


}
