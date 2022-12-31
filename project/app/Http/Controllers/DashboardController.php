<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\Event;
use App\Models\Rating;
use App\Models\Ticket;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Session::get('user');
        $totalEvent = Event::where('user_id', $user->id)->count();
        $hotelEvent = Event::where('user_id', $user->id)->where('category', 'Hotel')->count();
        $concertEvent = Event::where('user_id', $user->id)->where('category', 'Concert')->count();
        $audEvent = Event::where('user_id', $user->id)->where('category', 'Aud')->count();
        $totalRating = Rating::where('org_id', $user->id)->count();
        $ratingSum = Rating::where('org_id', $user->id)->sum('rating');

        $ticketSold = 0;
        $earned = 0;
        $events = Event::where('user_id', $user->id)->where('cost_type', 'Paid')->get();
        if($events->count() > 0){
            foreach ($events as $event){
                $soldCount = Ticket::where('event_id', $event->id)->sum('ticket_quantity');
                $earnedCount = Ticket::where('event_id', $event->id)->sum('total');
                $ticketSold = $ticketSold + $soldCount;
                $earned = $earned + $earnedCount;
            }
        }
        
        // return $ticketSold;

        if ($totalRating > 0)
            $avgRating = $ratingSum / $totalRating;
        else
            $avgRating = 0;
        // return $user;
        return view('admin.home', 
                compact('totalEvent', 'hotelEvent', 'concertEvent', 'audEvent', 'totalRating',
                 'avgRating', 'ticketSold', 'earned'));
    }
}
