<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;
use Carbon\Carbon;

class EventsSeeder extends Seeder
{
    public function run()
    {
        $today = Carbon::today(); // uses current date

        // past
        Event::create(['title'=>'Past Event 1','description'=>'Past 1','date'=>$today->copy()->subDays(4)->format('Y-m-d'),'time'=>'10:00','location'=>'Hall A']);
        Event::create(['title'=>'Past Event 2','description'=>'Past 2','date'=>$today->copy()->subDays(3)->format('Y-m-d'),'time'=>'11:00','location'=>'Hall B']);
        Event::create(['title'=>'Past Event 3','description'=>'Past 3','date'=>$today->copy()->subDays(2)->format('Y-m-d'),'time'=>'12:00','location'=>'Hall C']);

        // today
        Event::create(['title'=>'Today Event 1','description'=>'Today 1','date'=>$today->format('Y-m-d'),'time'=>'09:00','location'=>'Main Stage']);
        Event::create(['title'=>'Today Event 2','description'=>'Today 2','date'=>$today->format('Y-m-d'),'time'=>'14:00','location'=>'Room 101']);
        Event::create(['title'=>'Today Event 3','description'=>'Today 3','date'=>$today->format('Y-m-d'),'time'=>'18:00','location'=>'Open Ground']);

        // future
        Event::create(['title'=>'Future Event 1','description'=>'Future 1','date'=>$today->copy()->addDays(1)->format('Y-m-d'),'time'=>'10:00','location'=>'Auditorium']);
        Event::create(['title'=>'Future Event 2','description'=>'Future 2','date'=>$today->copy()->addDays(2)->format('Y-m-d'),'time'=>'11:30','location'=>'Auditorium']);
        Event::create(['title'=>'Future Event 3','description'=>'Future 3','date'=>$today->copy()->addDays(3)->format('Y-m-d'),'time'=>'16:00','location'=>'Auditorium']);
    }
}
