<?php

namespace App\Models;

use App\Models\ManageEvent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TicketMaster extends Model
{
    use HasFactory;
    protected $table = 'ticket_master';
    protected $fillable = [
        'event_id',
        'total_rows',
        'total_column',
        'row_no',
        'row_prefix',
        'price',
        'total_price'
    ];
    public function event()
    {
        return $this->belongsTo(ManageEvent::class, 'event_id');
    }
}
