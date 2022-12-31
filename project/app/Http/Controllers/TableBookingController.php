<?php

namespace App\Http\Controllers;

use App\Models\TableBooking;
use Illuminate\Http\Request;
use App\Models\Table;
use App\Models\User;
use Session;
use Carbon\Carbon;
use App\Notifications\EmailNotification;
use Illuminate\Support\Facades\Notification;

class TableBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        
        $tables = Table::where('event_id', $id)->get();
        // return $tables;
        $user = Session::get('user');
        return view('user.table.show', compact('tables', 'user'));
    }

    public function proceed($id) // table id
    {
        if (!Session::get('user')){
            return redirect()->route('view.login');
        }
        $user = Session::get('user');
        $table = Table::find($id);
        // return $table;
        return view('user.table.verify', compact('table', 'user'));
    }

    public function book($id) // table id
    {
        $user = Session::get('user');
        $table = Table::find($id);
        // return $table;
        $book = new TableBooking();
        $book->user_id = $user->id;
        $book->event_id = $table->event_id;
        $book->table_id = $table->id;
        $book->date = Carbon::today();
        $book->save();

        // send email notification
        $email = User::where('id', $table->user_id)->first();

        $data = [
            'email' => $email->email,
            'subject' => "Table Booking Alert",
            'body' => "Booking of table no. $table->table_no with capacity of
                         $table->seat has been confirmed.",
        ];

        Notification::send($user, new EmailNotification($data));

        return redirect()->route('show-tables', ['id' => $table->event_id])->with('success', 'Table booked');
        // return ;
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
     * @param  \App\Models\TableBooking  $tableBooking
     * @return \Illuminate\Http\Response
     */
    public function show(TableBooking $tableBooking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TableBooking  $tableBooking
     * @return \Illuminate\Http\Response
     */
    public function edit(TableBooking $tableBooking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TableBooking  $tableBooking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TableBooking $tableBooking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TableBooking  $tableBooking
     * @return \Illuminate\Http\Response
     */
    public function destroy(TableBooking $tableBooking)
    {
        //
    }
}
