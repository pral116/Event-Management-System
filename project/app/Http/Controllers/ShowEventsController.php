<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Rating;
use App\Models\Address;
use App\Models\User;
use App\Models\Ticket;
use App\Models\Table;
use Session;
use Carbon\Carbon;

class ShowEventsController extends Controller
{
    public function eventDetail($id) //event id
    {
        $user = Session::get('user');
        $detail = Event::findorfail($id);
        // return $detail;

        //ticket left
        $bookedTicket = Ticket::where('event_id', $id)->sum('ticket_quantity');
        // return $bookedTicket;

        // rating
        $totalRatings = Rating::where('org_id', $detail->user_id)->get();
        $ratingSum = Rating::where('org_id', $detail->user_id)->sum('rating');
        if ($totalRatings->count() > 0)
            $avgRating = $ratingSum / $totalRatings->count();
        else
            $avgRating = 0;
        
        // check for weather the user has rated
        if ($user){
            $userRating = Rating::where('org_id', $detail->user_id)->where('user_id', $user->id)->first();
        }
        else{
            $userRating = "";
        }

        //check table
        $tableExist = Table::where('event_id', $id)->get();
        // return $tableExist;
            
        // return $avgRating;
        return view('user.event.event-detail', compact('detail', 'totalRatings', 'avgRating', 'userRating',
                                             'bookedTicket', 'tableExist', 'user'));
    }

    // public function goBack(){
    //     return back();
    // }

    public function showLocation($id){  //event id
        $event_detail = Event::findorfail($id);
        return view('user.event.show-in-map', ["detail" => $event_detail]);
    }

    public function showUpcomingEvent(){
        $events = Event::where('date', '>=', Carbon::today())->get();
        return view('user.event.event', ["events" => $events]);
    }

    public function showThisMonth(){
        $events = Event::whereMonth('date', Carbon::now()->month)
                ->whereDay('date', '>=', Carbon::today()->day)
                ->get();
        // return $events;
        return view('user.event.event', ["events" => $events]);
    }

    public function showAll(){
        $events = Event::where('date', '>=', Carbon::today())->get();
        return view('user.event.event', ["events" => $events]);
    }

    public function showToday(){
        $events = Event::whereDay('date', Carbon::today()->day)->get();
        return view('user.event.event', ["events" => $events]);
    }

    public function showTomorrow(){
        $events = Event::whereDay('date', Carbon::tomorrow())->get();
        return view('user.event.event', ["events" => $events]);
    }

    public function showConcert(){
        $events = Event::where('category', 'Concert')->where('date', '>=', Carbon::today())->get();
        // $dt = Carbon::today()->month;
        // return $dt;
        return view('user.event.event', ["events" => $events]);
    }

    public function showAud(){
        $events = Event::where('category', 'Aud')->where('date', '>=', Carbon::today())->get();
        return view('user.event.event', ["events" => $events]);
    }

    public function showHotel(){
        $events = Event::where('category', 'Hotel')->where('date', '>=', Carbon::today())->get();
        // return $events;
        return view('user.event.event', ["events" => $events]);
    }

    public function showFree(){
        $events = Event::where('cost_type', 'Free')->where('date', '>=', Carbon::today())->get();
        return view('user.event.event', ["events" => $events]);
    }

    public function showByLocation(Request $request){
        $value = $request->search;
        $add = Address::where('name', $value)->first();
        if ($add){
            $events = Event::where('address_id', $add->id)
            ->where('date', '>=', Carbon::today())
            ->get();
        }
        else
            $events = Event::where('address_id', 0)->get();
        return view('user.event.event', compact('events'));
    }

    public function showTopEvent(){
        $users = User::where('is_admin', 1)->get('id');
        $rating = array();

        foreach ($users as $user){
           $ratingSum = Rating::where('org_id', $user->id)->sum('rating');
           if ($ratingSum != 0)
                $rating[$user->id] = $ratingSum;
        }

        if ($rating){
            $value = max($rating);
            $key = array_search($value, $rating);
            $events = Event::where('user_id', $key)
                ->where('date', '>=', Carbon::today())
                ->get();
        }
        else
            $events = Event::where('user_id', 0)->get();
        
        // echo "key: $key value: $value\n";

        // foreach($rating as $key=>$value){
        //     echo "$key \t $value\n";
        // }

        return view('user.event.event', ["events" => $events]);
    }

}
