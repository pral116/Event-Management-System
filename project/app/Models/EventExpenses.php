<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventExpenses extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'event_id',
        'purpose',
        'quantity',
        'rate',
        'total'
    ];
}
