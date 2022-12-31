<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Session;

class OrganizerEventController extends Controller
{
    public function viewMyEvents(Request $request){
        $user = Session::get('user');
        $myEvents = Event::where('user_id', $user->id)->get();
        return view('admin.my-event.my-event', ['myEvents' => $myEvents]);
    }

    public function viewMyEventDetail($id){
        return Event::findorfail($id);
    }
}
