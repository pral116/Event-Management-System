<?php

namespace App\Http\Controllers;

use App\Models\EventStaff;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Staff;
use Session;

class EventStaffController extends Controller
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
        $staffs = Staff::where('user_id', $user->id)->get();
        $eventStaffs = EventStaff::where('user_id', $user->id)
                                ->where('event_id', $id)
                                ->get();
        // return $eventStaff;
        return view('admin.manage.allocate-staff', ["event" => $event, "staffs" => $staffs, "eventStaffs" => $eventStaffs]);
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
            'staff' => 'required',
            'role' => 'required',
            'salary' => 'required',
        ]);
        $user = Session::get('user');
        $eventStaff = new EventStaff();
        $eventStaff->user_id = $user->id;
        $eventStaff->staff_id = $request->staff;
        $eventStaff->event_id = $id;
        $eventStaff->role = $request->role;
        $eventStaff->salary = $request->salary;
        $eventStaff->save();
        return back()->with('success', 'Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EventStaff  $eventStaff
     * @return \Illuminate\Http\Response
     */
    public function show(EventStaff $eventStaff)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EventStaff  $eventStaff
     * @return \Illuminate\Http\Response
     */
    public function edit(EventStaff $eventStaff, $id) //staff id
    {
        $user = Session::get('user');
        $eventStaff = EventStaff::findorfail($id);
        $staffs = Staff::where('user_id', $user->id)->get();
        // return $eventStaff;
        return view('admin.manage.edit-staff', ["eventStaff" => $eventStaff, "staffs" => $staffs]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EventStaff  $eventStaff
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EventStaff $eventStaff, $id)
    {
        $request->validate([
            'staff' => 'required',
            'role' => 'required',
            'salary' => 'required',
        ]);

        $user = Session::get('user');
        $eventStaff = EventStaff::findorfail($id);
        $eventStaff->user_id = $user->id;
        $eventStaff->staff_id = $request->staff;
        $eventStaff->event_id = $eventStaff->event_id;
        $eventStaff->role = $request->role;
        $eventStaff->salary = $request->salary;
        $eventStaff->save();
        return redirect()->route('admin.staff-view', ['id' => $eventStaff->event_id])->with('success', 'Your Data is Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EventStaff  $eventStaff
     * @return \Illuminate\Http\Response
     */
    public function destroy(EventStaff $eventStaff, $id)
    {
        try{
            EventStaff::find($id)->delete();
        }
        catch(\Exception $exception)
        {
            return back()->with('fail', 'Cannot delete item');
        }

        return back()->with('success', 'Deleted Successfully');
    }

}
