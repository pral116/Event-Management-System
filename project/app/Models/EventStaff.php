<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventStaff extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'staff_id',
        'event_id',
        'role',
        'salary'
    ];

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }
}
