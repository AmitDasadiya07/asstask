<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use Carbon\Carbon;

class EventAdminController extends Controller
{
    public function index()
    {
        $events = Event::orderBy('date', 'desc')->paginate(10);
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'date'  => 'required|date_format:Y-m-d',
            'time'  => 'nullable|date_format:H:i',
        ]);

        Event::create($request->only('title', 'description', 'date', 'time', 'location'));

        return redirect()->route('admin.events.index')->with('success', '✅ Event Added Successfully');
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('admin.events.edit', compact('event'));
    }

   public function update(Request $request, $id)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'date' => 'required|date',
        'time' => 'nullable',
        'location' => 'nullable|string',
        'description' => 'nullable|string',
    ]);

    $event = Event::findOrFail($id);

   

    $event->title = $request->title;
    $event->description = $request->description;
    $event->date = $request->date;
    $event->time = $request->time;
    $event->location = $request->location;
    $event->save(); 

    return redirect()
        ->route('admin.events.index')
        ->with('success', '✅ Event Updated Successfully!');
}


    public function destroy($id)
    {
        Event::findOrFail($id)->delete();
        return back()->with('success', '🗑️ Event Deleted Successfully');
    }

    //  Categorized View Method
    public function categorized()
    {
        $today = Carbon::today()->toDateString();

        $todayEvents  = Event::whereDate('date', $today)->orderBy('time', 'asc')->get();
        $futureEvents = Event::whereDate('date', '>', $today)->orderBy('date', 'asc')->get();
        $pastEvents   = Event::whereDate('date', '<', $today)->orderBy('date', 'desc')->get();

        return view('admin.events.categorized', compact('todayEvents', 'futureEvents', 'pastEvents'));
    }
}
