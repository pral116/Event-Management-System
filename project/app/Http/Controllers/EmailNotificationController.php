<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Ticket;
use App\Models\User;
use Session;
use App\Notifications\EmailNotification;
use Illuminate\Support\Facades\Notification;

class EmailNotificationController extends Controller
{
    public function writeEmail($id) // event id
    {
        return view('admin.messages.email', ['id' => $id]);
    }

    public function sendEmail(Request $request, $id) // event id
    {
        $request->validate([
            'email' => 'required|email',
            'subject' => 'required|min:8',
            'body' => 'required|min:20'
        ]);

        $user = Session::get('user');
        $persons = Ticket::where('event_id', $id)->get();
        // return $persons;

        $data = [
            'email' => $request->email,
            'subject' => $request->subject,
            'body' => $request->body,
        ];

        // Notification::send($persons, new EmailNotification($data));

        foreach ($persons as $person){
            Notification::send($person, new EmailNotification($data));
        }

        return back()->with('success', 'Email Sent');
        
    }

    // promotion
    public function indexPromoteEmail($id) // event id
    {
        // return $id;
        return view('admin.promotion.email', ['id' => $id]);
    }

    public function sendPromoteEmail($id, Request $request) // event id
    {
        $request->validate([
            'email' => 'required|email',
            'subject' => 'required|min:8',
            'body' => 'required|min:20'
        ]);

        $email = $request->email;
        $subject = $request->subject;
        $body = $request->body;

        $data = [
            'email' => $email,
            'subject' => $subject,
            'body' => $body,
        ];

        $user_id = Event::find($id);
        $events = Event::where('user_id', $user_id->user_id)->where('cost_type', 'Paid')->get();

        foreach ($events as $event){
            $persons = Ticket::where('event_id', $event->id)->get();
            foreach ($persons as $person){
                Notification::send($person, new EmailNotification($data));
            }
        }

        return back()->with('success', 'Email Sent');
    }
}
