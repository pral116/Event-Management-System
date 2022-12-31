<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Event;
use Illuminate\Http\Request;
use Session;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // private $event_id;
    // public $phone;
    // public $email;
    // public $quantity;
    // public $total;

    public function buyTicket($id){ //event id
        $user = Session::get('user');
        $event = Event::find($id);
        if ($user){
            return view('user.payment.purchase-detail', ["id"=>$id]);
        }
        else{
            return redirect()->route('view.login');
        }
        // return $event;
    }

    public function purchaseDetail($id, Request $request){ //event id
        $event = Event::find($id);
        // return $event;
        // $this->event_id = $id;
        // $this->phone = $request->get('phone');
        // $this->email = $request->get('email');
        // $this->qunata = $request->get('quantity');
        // // $this->total = $request->get('total');

        $phone = $request->phone;
        $email = $request->email;
        $quantity = $request->quantity;
        $total = $event->rate * $quantity;
        // return $total_amount;
        return view('user.payment.payment', compact('event', 'email', 'phone', 'quantity', 'total') );
    }

    public function verifyPayment(Request $request)
    {
        $token = $request->token;

        $args = http_build_query(array(
            'token' => $token,
            'amount'  => $request->amount,
            // 'email' => $request->email,
            // 'phone' => $request->phone,
            // 'quantity' => $request->quantity,
        ));
        
        $url = "https://khalti.com/api/v2/payment/verify/";
        
        # Make the call using API.
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$args);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $secret_key = config('app.secret_key');

        $headers = ["Authorization: Key $secret_key"];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
        // Response
        $response = curl_exec($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return $response;
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
    public function storePayment(Request $request)
    {
        // $user = Session::get('user');
        // $event = Event::find(respon);

        // $ticket = new Ticket();
        // $ticket->phone = "";
        // $ticket->email = "";
        // $ticket->user_id = $user->id;
        // $ticket->event_id = $event->id;
        // $ticket->ticket_quantity = "0";
        // $ticket->amount = response()->amount;
        // $ticket->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        //
    }
}
