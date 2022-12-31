<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\Event;
use App\Models\Ticket;
use App\Models\Table;
use Carbon\Carbon;

class SoldTicketController extends Controller
{
    public function index()
    {
        $user = Session::get('user');

        $events = Event::where('user_id', $user->id)->where('cost_type', 'Paid')->get();
        // return $events;
        return view('admin.ticket.ticket', ['events' => $events, 'tickets' => null]);
    }

    public function show(Request $request)
    {
        $user = Session::get('user');
        $id = $request->event_id;
        
        $events = Event::where('user_id', $user->id)->where('cost_type', 'Paid')->get();
        $tickets = Ticket::where('event_id', $request->event_id)->get();
        $soldTicket = Ticket::where('event_id', $request->event_id)->sum('ticket_quantity');
        $singleEvent = Event::find($request->event_id);
        $remainingTicket = $singleEvent->ticket_quantity - $soldTicket;

        $tableExist = Table::where('event_id', $request->event_id)->get();
        // return $tableExist;

        return view('admin.ticket.ticket',
                 ['events' => $events, 'tickets' => $tickets, 'soldTicket' => $soldTicket,
                  'remainingTicket' => $remainingTicket, 'id' => $id, 'tableExist' => $tableExist]);
    }
}
