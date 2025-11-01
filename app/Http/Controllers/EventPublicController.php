<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EventPublicController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        $events = Event::orderBy('date', 'asc')->orderBy('time', 'asc')->get();

        $todayEvents = $events->filter(fn($e) => $e->date->isSameDay($today));
        $futureEvents = $events->filter(fn($e) => $e->date->greaterThan($today));
        $pastEvents = $events->filter(fn($e) => $e->date->lessThan($today));
return view('admin.events.public', compact('todayEvents', 'futureEvents', 'pastEvents'));

    }
}
