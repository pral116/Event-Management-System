<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Address;
use Illuminate\Http\Request;
use Session;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function viewConcert(){
        $cities = Address::all();
        return view('admin.event.create-concert', ['cities'=> $cities]);
    }

    public function viewAud(){
        $cities = Address::all();
        return view('admin.event.create-aud', ['cities'=> $cities]);
    }

    public function viewHotel(){
        $cities = Address::all();
        return view('admin.event.create-hotel', ['cities'=> $cities]);
    }

    public function storeConcert(Request $request){

        $request->validate([
            'name' => 'required|min:5',
            'city' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'date' => 'required',
            'cost_type' => 'required',
            'image' => 'required',
            'description' => 'required|min:20'
        ]);

        $imageName = time() . '-' . $request->name . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);
         
        $user = Session::get('user');
        $event = new Event();
        $event->name = $request->name;
        $event->category = "Concert";
        $event->address_id = $request->city;
        $event->latitude = $request->lat;
        $event->longitude = $request->lng;
        $event->date = $request->date;
        $event->cost_type = $request->cost_type;
        $event->ticket_quantity = $request->ticket_quantity;
        $event->rate = $request->ticket_rate;
        $event->description = $request->description;
        $event->image = $imageName;
        $event->user_id = $user->id;
        $event->save();
        return back()->with('success', 'Event Added Successfully');
    }

    public function storeAud(Request $request){
        $request->validate([
            'name' => 'required|min:5',
            'city' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'date' => 'required',
            'cost_type' => 'required',
            'image' => 'required',
            'description' => 'required|min:20'
        ]);

        $imageName = time() . '-' . $request->name . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);
         
        $user = Session::get('user');
        $event = new Event();
        $event->name = $request->name;
        $event->category = "Aud";
        $event->address_id = $request->city;
        $event->latitude = $request->lat;
        $event->longitude = $request->lng;
        $event->date = $request->date;
        $event->cost_type = $request->cost_type;
        $event->ticket_quantity = $request->ticket_quantity;
        $event->rate = $request->ticket_rate;
        $event->description = $request->description;
        $event->image = $imageName;
        $event->user_id = $user->id;
        $event->save();
        return back()->with('success', 'Event Added Successfully');
    }

    public function storeHotel(Request $request){
        $request->validate([
            'name' => 'required|min:5',
            'city' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'date' => 'required',
            'cost_type' => 'required',
            'image' => 'required',
            'description' => 'required|min:20'
        ]);

        $imageName = time() . '-' . $request->name . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);
         
        $user = Session::get('user');
        $event = new Event();
        $event->name = $request->name;
        $event->category = "Hotel";
        $event->address_id = $request->city;
        $event->latitude = $request->lat;
        $event->longitude = $request->lng;
        $event->date = $request->date;
        $event->cost_type = $request->cost_type;
        $event->ticket_quantity = $request->ticket_quantity;
        $event->rate = $request->ticket_rate;
        $event->description = $request->description;
        $event->image = $imageName;
        $event->user_id = $user->id;
        $event->save();
        return back()->with('success', 'Event Added Successfully');
    }

    public function viewEventEdit($id){
        $event = Event::findorfail($id);
        $cities = Address::all();
        return view('admin.event.edit', ["event" => $event, "cities"=>$cities, "id"=>$id]);
    }

    public function updateEvent($id, Request $request){
        $request->validate([
            'name' => 'required|min:5',
            'city' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'date' => 'required',
            'cost_type' => 'required',
            'image' => 'required',
            'description' => 'required|min:20'
        ]);

        $event = Event::findorfail($id);

        $imageName = time() . '-' . $request->name . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);
         
        $user = Session::get('user');
        $event->name = $request->name;
        $event->category = $event->category;
        $event->address_id = $request->city;
        $event->latitude = $request->lat;
        $event->longitude = $request->lng;
        $event->date = $request->date;
        $event->cost_type = $request->cost_type;
        $event->ticket_quantity = $request->ticket_quantity;
        $event->rate = $request->ticket_rate;
        $event->description = $request->description;
        $event->image = $imageName;
        $event->user_id = $user->id;
        $event->save();
        return redirect()->route('admin.view-my-event')->with('success', 'Successfully Edited');

    }

    public function index()
    {
        $user = Session::get('user');
        $events = Event::where('user_id', $user->id)->get();
        return view('admin.manage.index', ["events" => $events]);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }
}
