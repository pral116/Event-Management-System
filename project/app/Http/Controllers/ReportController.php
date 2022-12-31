<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventStaff;
use App\Models\EventExpenses;
use App\Models\Ticket;

class ReportController extends Controller
{
    public function index($id) // event id
    {
        $event = Event::findorfail($id);
        return view('admin.report.choose', ["event" => $event]);
    }

    public function indexOverall($id) //event id
    {
        $event = Event::findorfail($id);
        $eventStaff = EventStaff::where('event_id', $id)->sum('salary');
        $eventExpenses = EventExpenses::where('event_id', $id)->sum('total');
        $ticketSales = Ticket::where('event_id', $event->id)->sum('total');

        $revenue = $ticketSales - ($eventStaff + $eventExpenses) ;
        // return $ticketSales;
        return view('admin.report.overall', compact('event', 'eventStaff', 'eventExpenses', 'ticketSales', 'revenue') );
    }

    public function indexStaff($id) //event id
    {
        $event = Event::findorfail($id);
        $eventStaff = EventStaff::where('event_id', $id)->get();
        $totalAmount = EventStaff::where('event_id', $id)->sum('salary');
        return view('admin.report.staff', ["event" => $event, 'eventStaff' => $eventStaff, 'total' => $totalAmount]);
    }

    public function indexExpenses($id) //event id
    {
        $event = Event::findorfail($id);
        $eventExpenses = EventExpenses::where('event_id', $id)->get();
        $totalAmount = EventExpenses::where('event_id', $id)->sum('total');
        // return $totalAmount;
        return view('admin.report.expenses', ["event" => $event, 'eventExpenses' => $eventExpenses, 'total' => $totalAmount]);
    }
}
