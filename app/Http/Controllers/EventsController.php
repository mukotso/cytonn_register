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
        $event = $this->eventRepository->createEvent($request->all());
        if(request()->expectsJson()) {
            return response()->json($event, 200);
        }else{
            return  redirect()->route('events.index');
        }

    }

    public function update(EventRequest $request, $event)
    {
        $event = $this->eventRepository->updateEvent($event, $request->all());
        if(request()->expectsJson()) {
            return response()->json($event, 200);
        }else{
            return  redirect()->route('events.index');
        }

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
        $this->eventRepository->deleteEvent($event->id);
        if(request()->expectsJson()) {
            return response()->json(200);
        }else{
            return  redirect()->route('events.index');
        }

    }


}
