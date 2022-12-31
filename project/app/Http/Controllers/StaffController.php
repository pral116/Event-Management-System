<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //Shows all the staff of respective user.
    public function index()
    {
        $user = Session::get('user');
        $staffs = Staff::where('user_id', $user->id)->get();
        // return $staffs;
        return view('admin.staff.index', ['staffs' => $staffs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // displays add staff form
    public function create()
    {
        return view('admin.staff.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // stores staff in database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required',
        ]);
        $user = Session::get('user');
        $staff = new Staff;
        $staff->name = $request->name;
        $staff->address = $request->address;
        $staff->gender = $request->gender;
        $staff->phone = $request->phone;
        $staff->email = $request->email;
        $staff->user_id = $user->id;
        // return $user->id;
        $staff->save();
        return back()->with('success', 'Staff Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function show(staff $staff)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\staff  $staff
     * @return \Illuminate\Http\Response
     */
    // displays form for editing staff details
    public function edit(staff $staff, $id)
    {
        $staff = Staff::find($id);
        return view('admin.staff.edit', ['staff' => $staff]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\staff  $staff
     * @return \Illuminate\Http\Response
     */
    // updates the data
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required',
        ]);

        $staff = Staff::find($id);
        $user = Session::get('user');
        $staff->name = $request->name;
        $staff->address = $request->address;
        $staff->gender = $request->gender;
        $staff->phone = $request->phone;
        $staff->email = $request->email;
        $staff->user_id = $user->id;
        $staff->save();
        return redirect()->route('admin.show-staff')->with('success', 'Your Detail is Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function destroy(staff $staff, $id)
    {
        try{
            Staff::find($id)->delete();
        }
        catch(\Exception $exception)
        {
            return back()->with('fail', 'Cannot delete item');
        }

        return back()->with('success', 'Deleted Successfully');
    }
}
