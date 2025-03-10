<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageTickets extends Model
{
    use HasFactory;
    protected $table = 'manage_tickets';
    protected $fillable = ['event_id', 'ticket_type', 'ticket_no', 'ticket_price', 'status', 'purchease_by', 'purchase_date'];
}
