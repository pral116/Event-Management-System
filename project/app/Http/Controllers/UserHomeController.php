<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Polling;
use Carbon\Carbon;
use Session;

class UserHomeController extends Controller
{
    public function home(){
        $events = Event::latest()->get()->take(4);
        $upcoming = Event::where('date', '>=', Carbon::today())
                    ->latest()
                    ->get()
                    ->take(4);
        
        $thisMonth = Event::whereMonth('date', Carbon::today()->month)
                    ->where('date', '>=', Carbon::today())
                    ->latest()
                    ->get()
                    ->take(4);

        $poll = Polling::select(Polling::raw('count(event_id) as event_count, event_id'))
                ->where('event_id', '<>', 0)
                ->groupBy('event_id')
                ->get();
        $b = 0;
        $id = 0;
        foreach($poll as $a){
            if ($a->event_count > $b){
                $b = $a->event_count;
                $id = $a->event_id;
            }
        }
        $topVoted = Event::find($id);
        // return $topVoted;

        return view('user.home', compact('events', 'upcoming', 'thisMonth', 'topVoted'));
    }
}
