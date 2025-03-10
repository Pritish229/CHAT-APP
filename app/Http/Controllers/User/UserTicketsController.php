<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\ManageTickets;
use App\Http\Controllers\Controller;

class UserTicketsController extends Controller
{
    public function index($id)
    {
        return view('User.Ticket.Book-Tickets', ['id' => $id]);
    }

    public function ticketHistory(Request $request){
        $id = $request->session()->get('user_id',);
        return view('User.Ticket.Ticket-History', ['id' => $id]);
    }

    public function ticketList($id)
    {
        $ticketData = ManageTickets::where('event_id', $id)->get();

        // Group by ticket_type
        $groupedTickets = $ticketData->groupBy('ticket_type');

        return response()->json($groupedTickets, 200);
    }
    public function confirmBooking(Request $request)
    {
        $eventId = $request->event_id;
        // Cast purchase_by to integer
        $purchease_by = (int) $request->purchease_by;
        $tickets = $request->tickets;

        foreach ($tickets as $ticket) {
            // Find the ticket by event_id and ticket_no
            $existingTicket = ManageTickets::where('event_id', $eventId)
                ->where('ticket_no', $ticket['ticket_no'])
                ->first();

            if ($existingTicket) {
                // Update the existing ticket
                $existingTicket->update([
                    'purchase_date' => now(),
                    'purchease_by' => $purchease_by,  // Updated as integer
                    'status' => '1',
                ]);
            }
        }

        return response()->json(['message' => 'Booking updated successfully'], 200);
    }

    public function userTickets($id)
    {
        // Get tickets and associated event data
        $tickets = ManageTickets::leftJoin('manage_events', 'manage_events.id', '=', 'manage_tickets.event_id')
            ->where('manage_tickets.purchease_by', $id)
            ->select(
                'manage_tickets.id', 
                'manage_tickets.ticket_no', 
                'manage_tickets.event_id', 
                'manage_events.event_title', 
                'manage_events.event_date', 
                'manage_events.status' 
            )
            ->get();

        // Group tickets by event_id
        $groupedTickets = $tickets->groupBy('event_id')->map(function ($ticketGroup) {
            
            $ticketNumbers = $ticketGroup->pluck('ticket_no')->map(function ($ticketTitle, $index) {
                return "{$ticketTitle}"; 
            })->implode(', '); 

           
            return [
                'event_id' => $ticketGroup->first()->event_id,
                'event_title' => $ticketGroup->first()->event_title,
                'event_date' => $ticketGroup->first()->event_date,
                'ticket_no' => $ticketNumbers
            ];
        });

        // Convert the grouped data to an array of events
        $response = $groupedTickets->values()->toArray();

        return response()->json([
            'data' => $response
        ], 200);
    }
}
