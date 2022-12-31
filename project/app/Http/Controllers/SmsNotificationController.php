<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Event;
use Nexmo\Laravel\Facade\Nexmo;

class SmsNotificationController extends Controller
{
    public function writeSMS($id) // event id
    {
        // return $id;
        return view('admin.messages.sms', ['id' => $id]);
    }

    public function send(Request $request, $id) // event id
    {
        $request->validate([
            'message' => 'required',
        ]);
        $peoples = Ticket::where('event_id', $id)->get();
        $message = $request->message;
        
        foreach ($peoples as $people){
            // $phone = ;
            Nexmo::message()->send([
                'to' => "977$people->phone",
                'from' => 'sender',
                'text' => $message
            ]);
            // echo "SMS\n";
        }

        return back()->with('success', 'Message Sent');
    }

    // promotion
    public function choose($id) // event id
    {
        return view('admin.promotion.choose', ['id' => $id]);
    }

    public function indexPromoteSMS($id) // event id
    {
        // return $id;
        return view('admin.promotion.sms', ['id' => $id]);
    }

    public function sendPromoteSMS($id, Request $request) // event id
    {
        $request->validate([
            'message' => 'required',
        ]);

        $message = $request->message;

        $user_id = Event::find($id);
        $events = Event::where('user_id', $user_id->user_id)->where('cost_type', 'Paid')->get();

        foreach ($events as $event){
            $peoples = Ticket::where('event_id', $event->id)->get();
            foreach ($peoples as $people){
                Nexmo::message()->send([
                    'to' => "977$people->phone",
                    'from' => 'sender',
                    'text' => $message
                ]);
            }
        }

        return back()->with('success', 'Message Sent');
    }
}
