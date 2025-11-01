<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

class EventController extends Controller
{
    // GET /api/events
    public function index()
    {
        // fetch all events
        $events = Event::orderBy('date','asc')->orderBy('time','asc')->get();
        return response()->json($events);
    }

    // POST /api/events
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date_format:Y-m-d',
            'time' => 'nullable|date_format:H:i',
            'location' => 'nullable|string',
        ]);

        $event = Event::create($validated);
        return response()->json($event, 201);
    }

    // GET /api/events/{id}
    public function show($id)
    {
        $event = Event::findOrFail($id);
        return response()->json($event);
    }

    // PUT/PATCH /api/events/{id}
    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date_format:Y-m-d',
            'time' => 'nullable|date_format:H:i',
            'location' => 'nullable|string',
        ]);
        $event->update($validated);
        return response()->json($event);
    }

    // DELETE /api/events/{id}
    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();
        return response()->json(['message'=>'deleted']);
    }

    // Optional: categorized endpoint /api/events/categorized
    public function categorized()
    {
        $today = Carbon::today();
        $events = Event::orderBy('date','asc')->orderBy('time','asc')->get();

        $todayEvents = $events->filter(fn($e) => $e->date->isSameDay($today))->values();
        $futureEvents = $events->filter(fn($e) => $e->date->greaterThan($today))->values();
        $pastEvents = $events->filter(fn($e) => $e->date->lessThan($today))->values();

        return response()->json([
            'today' => $todayEvents,
            'future' => $futureEvents,
            'past' => $pastEvents,
        ]);
    }
}
