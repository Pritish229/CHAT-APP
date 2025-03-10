<?php

namespace App\Http\Controllers\User;

use App\Models\ManageUser;
use App\Models\ManageEvent;
use App\Models\ManageTickets;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class BotmanController extends Controller
{

    public function handle()
    {
        $botman = app('botman');

        $botman->fallback(function ($bot) {
            $bot->reply('Sorry, I don\'t understand.');
        });

        $botman->hears('hi|hello', function ($bot) {
            $id = Session::get('user_id');
            $user = $id ? ManageUser::find($id) : null;
            $username = $user ? $user->f_name : 'there';
            $bot->reply("Hello, $username! 👋 How can I assist you?");
        });

        $botman->hears('.*Help.*', function ($bot) {
            $bot->reply('
            User Actions: <br>
            -> Type "Latest Events" For Event Lists.. <br>
            -> Type Event name "Details" For Event information..<br>
            -> Type "Book" "Number of tickets" of "Event Name" <br>');
        });

        $botman->hears('bye|goodbye', function ($bot) {
            $bot->reply('Goodbye! 👋');
        });

        $botman->hears('.*Latest Events|Latest Event|Current Events|Current Event.*', function ($bot) {
            $events = ManageEvent::where('status', '1')->latest()->get();
            if ($events->isEmpty()) {
                $bot->reply("No upcoming events found.");
                return;
            }

            $response = "Here are the latest events:<br>";
            foreach ($events as $event) {
                $response .= "-> {$event->event_title} <br>";
            }

            $response .= "<br>Type the name of an event for specific details.";
            $bot->reply($response);
        });

        $botman->hears('.*Details.*', function ($bot) {
            $userMessage = $bot->getMessage()->getText();
            $eventName = trim(str_replace('Details', '', $userMessage));

            if (empty($eventName)) {
                $bot->reply("Please provide an event name.");
                return;
            }

            $event = ManageEvent::whereRaw('LOWER(event_title) LIKE ?', [strtolower("%$eventName%")])->first();
            if (!$event) {
                $bot->reply("Event not found.");
                return;
            }

            $availableTickets = ManageTickets::select('ticket_type', DB::raw('COUNT(*) as available_tickets'))
                ->where('event_id', $event->id)
                ->where('status', '0')
                ->groupBy('ticket_type')
                ->get();

            $response = "🔹 *Title:* {$event->event_title} <br>";
            $response .= "📆 *Date:* {$event->event_date} <br>";
            $response .= "🎟️ *Available Tickets:* <br>";

            if ($availableTickets->isEmpty()) {
                $response .= "No tickets available.<br>";
            } else {
                foreach ($availableTickets as $ticket) {
                    $response .= "{$ticket->ticket_type}: {$ticket->available_tickets} <br>";
                }
            }

            $bot->reply($response);
        });

        $botman->hears('Book {num} {ticketType} of {eventTitle}', function ($bot, $num, $ticketType, $eventTitle) {
          

            $userId = Session::get('user_id');

            if (!$userId) {
                $bot->reply("You must be logged in to book tickets.");
                return;
            }

            $event = ManageEvent::where('event_title', 'like', "%$eventTitle%")->first();

            if (!$event) {
                $bot->reply("Event not found. Please check the event name and try again.");
                return;
            }

            $availableTickets = ManageTickets::where('event_id', $event->id)
                ->where('ticket_type', $ticketType)
                ->where('status', '0')
                ->get();

            if ($availableTickets->count() < $num) {
                $bot->reply("Only {$availableTickets->count()} tickets are available. Please try again with fewer tickets.");
                return;
            }

            $updatedRows = ManageTickets::where('event_id', $event->id)
                ->where('ticket_type', $ticketType)
                ->where('status', '0')
                ->orderBy('id')
                ->limit($num)
                ->update([
                    'status' => '1',
                    'purchease_by' => $userId,
                    'purchase_date' => now(),
                ]);

            $bot->reply($updatedRows == $num ? "✅ Ticket(s) booked successfully! Please check your history." : "❌ Booking failed. Please try again.");
        });




        $botman->listen();
    }
}
