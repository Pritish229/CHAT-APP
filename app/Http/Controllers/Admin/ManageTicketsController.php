<?php

namespace App\Http\Controllers\Admin;

use App\Models\ManageEvent;
use Illuminate\Http\Request;
use App\Models\ManageTickets;
use App\Http\Controllers\Controller;

class ManageTicketsController extends Controller
{
    public function addTickets(Request $request)
    {
        $eventId = $request->input('event_id');
        $tickets = $request->input('tickets');
        $ticketData = [];

        foreach ($tickets as $ticket) {
            $ticketData[] = [
                'event_id' => $eventId,
                'ticket_no' => $ticket['ticket_no'],
                'ticket_type' => $ticket['ticket_type'],
                'ticket_price' => $ticket['ticket_price'],
                'status' => $ticket['status'] ?? 0,  // Default to '0' if status is not provided
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Bulk insert the tickets into the database
        ManageTickets::insert($ticketData);
       
        ManageEvent::where('id', $eventId)->update(['status' => '1']);

        return response()->json(['message' => 'Tickets inserted successfully!']);
    }
}
