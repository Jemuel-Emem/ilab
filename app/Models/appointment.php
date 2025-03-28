<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class appointment extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'service_id',
        'appointment_date',
        'appointment_time',
        'notes',
        'status',
        'payment_status'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
