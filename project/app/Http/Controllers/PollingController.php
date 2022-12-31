<?php

namespace App\Http\Controllers;

use App\Models\Polling;
use Illuminate\Http\Request;
use Session;

class PollingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user = Session::get('user');
        if ($user){
            $polling = new Polling();
            $polling->user_id = $user->id;
            $polling->event_id = $request->poll_event;
            $polling->save();
            return back();
        }
        else
            return redirect()->route('view.login');
        // return $request->poll_event;
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
     * @param  \App\Models\Polling  $polling
     * @return \Illuminate\Http\Response
     */
    public function show(Polling $polling)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Polling  $polling
     * @return \Illuminate\Http\Response
     */
    public function edit(Polling $polling)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Polling  $polling
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Polling $polling)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Polling  $polling
     * @return \Illuminate\Http\Response
     */
    public function destroy(Polling $polling)
    {
        //
    }
}
