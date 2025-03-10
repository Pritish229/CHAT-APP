<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageEvent extends Model
{
    use HasFactory;
    protected $table = 'manage_events';
    protected $fillable = [
        'event_code',
        'event_title',
        'event_date',
        'state_id',
        'district_id',
        'city_id',
        'pincode',
        'event_banner',
        'total_tickets',
        'event_desc',
        'status',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($event) {
            if (!$event->event_code) {
                $event->event_code = uniqid('EV_');
            }
        });
    }
}
