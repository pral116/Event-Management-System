<?php

namespace App\Http\Controllers;

use App\Models\EventExpenses;
use Illuminate\Http\Request;
use App\Models\Event;
// use App\Models\Staff;
use Session;

class EventExpensesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id) //event id
    { 
        $user = Session::get('user');
        $event = Event::findorfail($id);
        // $staffs = Staff::where('user_id', $user->id)->get();
        $eventExpenses = EventExpenses::where('user_id', $user->id)
                                ->where('event_id', $id)
                                ->get();
        return view('admin.manage.manage-expenses', ['event' => $event, 'eventExpenses' => $eventExpenses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id) //event id
    {
        $request->validate([
            'purpose' => 'required',
            'quantity' => 'required',
            'rate' => 'required',
        ]);

        $user = Session::get('user');
        $eventExpenses = new EventExpenses();
        $eventExpenses->user_id = $user->id;
        $eventExpenses->event_id = $id;
        $eventExpenses->purpose = $request->purpose;
        $eventExpenses->quantity = $request->quantity;
        $eventExpenses->rate = $request->rate;
        $eventExpenses->total = $request->quantity * $request->rate;
        $eventExpenses->save();
        return back()->with('success', 'Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EventExpenses  $eventExpenses
     * @return \Illuminate\Http\Response
     */
    public function show(EventExpenses $eventExpenses)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EventExpenses  $eventExpenses
     * @return \Illuminate\Http\Response
     */
    public function edit(EventExpenses $eventExpenses, $id) //expenses id
    {
        $user = Session::get('user');
        $eventExpenses = EventExpenses::findorfail($id);
        return view('admin.manage.edit-expenses', ["eventExpenses" => $eventExpenses]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EventExpenses  $eventExpenses
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EventExpenses $eventExpenses, $id) //expenses id
    {
        $request->validate([
            'purpose' => 'required',
            'quantity' => 'required',
            'rate' => 'required',
        ]);

        $user = Session::get('user');
        $eventExpenses = EventExpenses::findorfail($id);
        $eventExpenses->user_id = $user->id;
        $eventExpenses->event_id = $eventExpenses->event_id;
        $eventExpenses->purpose = $request->purpose;
        $eventExpenses->quantity = $request->quantity;
        $eventExpenses->rate = $request->rate;
        $eventExpenses->total = $request->quantity * $request->rate;
        $eventExpenses->save();
        return redirect()->route('admin.expenses-view', ['id'=> $eventExpenses->event_id])->with('success', 'Your Data is Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EventExpenses  $eventExpenses
     * @return \Illuminate\Http\Response
     */
    public function destroy(EventExpenses $eventExpenses, $id)
    {
        try{
            EventExpenses::find($id)->delete();
        }
        catch(\Exception $exception)
        {
            return back()->with('fail', 'Cannot delete item');
        }

        return back()->with('success', 'Deleted Successfully');

    }
}
