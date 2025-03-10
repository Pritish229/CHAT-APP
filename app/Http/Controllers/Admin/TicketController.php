<?php

namespace App\Http\Controllers\Admin;

use App\Models\ManageEvent;
use App\Models\TicketMaster;
use Illuminate\Http\Request;
use App\Models\ManageTickets;
use App\Http\Controllers\Controller;

class TicketController extends Controller
{
    public function ticketPage($id, $total_tickets)
    {
        $event_tickets = ManageEvent::find($id);
        $row_column = TicketMaster::where('event_id', $id)->first();

        // Ensure $row_column exists and values are not null
        if ($row_column && !is_null($row_column->total_rows) && !is_null($row_column->total_column)) {
            if ($event_tickets->total_tickets == ($row_column->total_rows * $row_column->total_column)) {
                return view('Admin.Manage-Tickets.Manage-Ticket', ['id' => $id, 'total_tickets' => $total_tickets]);
            }
        }

        return view('Admin.Manage-Tickets.Add-Tickets', ['id' => $id, 'total_tickets' => $total_tickets]);
    }

    public function ticketsListPage()
    {
        return view('Admin.Manage-Tickets.Ticket-List');
    }


    public function storeTicket(Request $request)
    {
        $validated = $request->validate([
            'event_id' => 'required|integer',
            'totalRows' => 'required|integer|min:1',
            'total_columns' => 'required|integer|min:1',
            'prefixes' => 'required|array',
            'prefixes.*.row' => 'required|integer|min:1',
            'prefixes.*.prefix' => 'required|string|max:255',
            'prefixes.*.price' => 'required|numeric|min:0',
            'prefixes.*.total_price' => 'required|numeric|min:0',
        ]);

        $eventId = $validated['event_id'];
        $totalRows = $validated['totalRows'];
        $totalColumns = $validated['total_columns'];
        $prefixes = $validated['prefixes'];

        try {
            // Get existing records for the event
            $existingRows = TicketMaster::where('event_id', $eventId)->get()->keyBy('row_no');

            // Collect row numbers to keep
            $newRowNumbers = collect($prefixes)->pluck('row')->toArray();

            foreach ($prefixes as $prefix) {
                $rowNo = $prefix['row'];

                if (isset($existingRows[$rowNo])) {
                    // Update existing row
                    $existingRows[$rowNo]->update([
                        'total_rows' => $totalRows,
                        'total_column' => $totalColumns,
                        'row_prefix' => $prefix['prefix'],
                        'price' => $prefix['price'],
                        'total_price' => $prefix['total_price'],
                    ]);
                } else {
                    // Insert new row
                    TicketMaster::create([
                        'event_id' => $eventId,
                        'total_rows' => $totalRows,
                        'total_column' => $totalColumns,
                        'row_no' => $rowNo,
                        'row_prefix' => $prefix['prefix'],
                        'price' => $prefix['price'],
                        'total_price' => $prefix['total_price'],
                    ]);
                }
            }

            // Delete rows that are not in the newRowNumbers list
            TicketMaster::where('event_id', $eventId)
                ->whereNotIn('row_no', $newRowNumbers)
                ->delete();

            return response()->json([
                'success' => true,
                'message' => 'Ticket data saved successfully.',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while saving the ticket data.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function getTicketData($id)
    {
        $ticketData = TicketMaster::where('event_id', $id)->get();
        return response()->json(
            [
                'data' => $ticketData,
            ],
            200
        );
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
