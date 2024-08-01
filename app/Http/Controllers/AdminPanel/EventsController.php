<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use App\Http\Traits\HandleApiResponse;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class EventsController extends Controller
{
    // use HandleApiResponse;

    // public function index()
    // {
    //     $events = Event::all();
    //     return view('AdminPanel.events.index', get_defined_vars());
    // }

    // public function create()
    // {
    //     return view('AdminPanel.events.create');
    // }

    // public function store(Request $request)
    // {
    //     $validated = $request->validate(Event::rules());
    //     $events = Event::create($validated);
    //     flashy()->success(__('lang.created'));
    //     return redirect()->route('events.index');
    // }


    // public function edit(Event $event)
    // {
    //     return view('AdminPanel.events.edit', get_defined_vars());
    // }


    // public function update(Request $request, Event $event)
    // {
    //     $validated = $request->validate(Event::rules());
    //     $event->update($validated);
    //     flashy()->success(__('lang.updated'));
    //     return redirect()->route('events.index');
    // }


    // public function destroy(string $id)
    // {
    //     $event = Event::findOrFail($id);
    //     $event->delete();
    //     flashy()->success(__('lang.deleted'));
    //     return redirect()->route('events.index');
    // }



    // public function EventsApi()
    // {
    //   $events=  Event::all() ? Event::all() : [];
    //     return $this->handleSuccess($events, 'Events retrieved successfully', 200);
    // }


    protected const CACHE_KEY_EVENTS = 'events';
    protected const CACHE_EXPIRATION = 60; // in minutes

    public function index()
    {
        $events = $this->getCachedEvents();
        return view('AdminPanel.events.index', compact('events'));
    }

    public function create()
    {
        return view('AdminPanel.events.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate(Event::rules());
        Event::create($validated);

        // Clear cache after storing a new event
        $this->clearEventsCache();

        flashy()->success(__('lang.created'));
        return redirect()->route('events.index');
    }

    public function edit(Event $event)
    {
        return view('AdminPanel.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate(Event::rules());
        $event->update($validated);

        // Clear cache after updating an event
        $this->clearEventsCache();

        flashy()->success(__('lang.updated'));
        return redirect()->route('events.index');
    }

    public function destroy(string $id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        // Clear cache after deleting an event
        $this->clearEventsCache();

        flashy()->success(__('lang.deleted'));
        return redirect()->route('events.index');
    }

    public function EventsApi()
    {
        $events = $this->getCachedEvents();
        return $this->handleSuccess($events, 'Events retrieved successfully', 200);
    }

    private function getCachedEvents()
    {
        return Cache::remember(self::CACHE_KEY_EVENTS, now()->addMinutes(self::CACHE_EXPIRATION), function () {
            return Event::all();
        });
    }

    private function clearEventsCache()
    {
        Cache::forget(self::CACHE_KEY_EVENTS);
    }
}
