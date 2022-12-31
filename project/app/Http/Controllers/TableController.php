<?php

namespace App\Http\Controllers;

use App\Models\Table;
use App\Models\Event;
use App\Models\TableBooking;
use Session;
use Illuminate\Http\Request;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id) //event id
    {
        $event = Event::find($id);
        $tables = Table::where('event_id', $id)->get();
        // return $event;
        return view('admin.table.index', compact('event', 'tables'));
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
            'table' => 'required',
            'capacity' => 'required',
        ]);
        $user = Session::get('user');

        $check = Table::where('event_id', $id)->where('table_no', $request->table)->get();
        // return $check;
        if ($check->count() > 0){
            return back()->with('fail', "Faied! Table Already Exists"); 
        }
        else{
            $table = new Table();
            $table->event_id = $id;
            $table->user_id = $user->id;
            $table->table_no = $request->table;
            $table->seat = $request->capacity;
            $table->save();
            return back()->with('success', "Added Successfully");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Table  $table
     * @return \Illuminate\Http\Response
     */
    public function showBookedTable(Table $table, $id)  //event id
    {
        $bookedList = TableBooking::where('event_id', $id)->get();
        // return $bookedList;
        return view('admin.table.booked', compact('bookedList'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Table  $table
     * @return \Illuminate\Http\Response
     */
    public function edit(Table $table, $id)
    {
        $table = Table::find($id);

        return view('admin.table.edit', compact('table'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Table  $table
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Table $table, $id)
    {
        $request->validate([
            'table' => 'required',
            'capacity' => 'required',
        ]);

        $update = Table::find($id);

        $update->table_no = $request->table;
        $update->seat = $request->capacity;
        $update->save();

        return redirect()->route('admin.add-table', ['id' => $update->event_id])->with('success', 'Your data is updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Table  $table
     * @return \Illuminate\Http\Response
     */
    public function destroy(Table $table)
    {
        //
    }
}
