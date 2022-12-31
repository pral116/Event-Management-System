<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Event;
use App\Models\TableBooking;
use Session;

class BookedController extends Controller
{
    public function show()
    {
        $checkUser = Session::get('user');
        // return $checkUser;
        if (!$checkUser){
            return redirect()->route('view.login');
        }

        //booked events
        $myEvents = Ticket::where('user_id', $checkUser->id)->get();
        //booked tables
        $tables = TableBooking::where('user_id', $checkUser->id)->get();
        // return $tables;
        
        return view('user.my-event.booked-event', compact('myEvents', 'tables'));
    }
}
