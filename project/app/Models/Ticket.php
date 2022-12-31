<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Ticket extends Model
{
    use HasFactory, Notifiable;
    protected $fillable = [
        'phone',
        'email',
        'user_id',
        'event_id',
        'ticket_quantity',
        'rate',
        'total',
        'date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }
}
