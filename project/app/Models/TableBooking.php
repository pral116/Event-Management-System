<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TableBooking extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'event_id',
        'table_id',
        'date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function table()
    {
        return $this->belongsTo(Table::class);
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
