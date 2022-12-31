<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Event;
use Illuminate\Http\Request;
use Session;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function rating(Request $request)
    {
        $user = Session::get('user');
        $event = Event::where('id', $request->event_id)->first();
        // return $event;
        if ($user){
            $rated = Rating::where('user_id', $user->id)->where('org_id', $event->user_id)->first();
            // return $rated;
            if ($rated){
                return back()->with('fail', 'Already rated');
            }
            else{
                $newRating = new Rating();
                $newRating->user_id = $user->id;
                $newRating->org_id = $event->user_id;
                $newRating->rating = $request->rating;
                $newRating->save();
                return back()->with('success', "You rated this Organizer");
            }
        }
        else{
            return redirect()->route('view.login');
        }
    }

    public function index()
    {
        //
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
     * @param  \App\Models\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function show(Rating $rating)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function edit(Rating $rating)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rating $rating)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rating $rating)
    {
        //
    }
}
