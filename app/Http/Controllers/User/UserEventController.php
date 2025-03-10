<?php

namespace App\Http\Controllers\User;

use App\Models\ManageEvent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserEventController extends Controller
{
    public function index()
    {
        return view('user.Event.EventList');
    }
    public function ManageEventDetailssPage($id)
    {
        return view('User.Ticket.Manage-Tickets' , ['id' => $id]);
    }

    public function getAllEvents($status)
    {
        $events = ManageEvent::where('status', '=', $status)->get();

        foreach ($events as $event) {
            $event->event_banner_url = asset('storage/' . $event->event_banner);
        }

        return response()->json([
            'data' => $events,
            'code' => 200,
            'message' => 'Events fetched successfully'
        ]);
    }

    public function fatchEvent($id)
    {
        $event = ManageEvent::select(
            'manage_events.*',
            'city.name as city_title',
            'district.district_title as district_title',
            'state.state_title as state_title'
        )
            ->leftJoin('city', 'manage_events.city_id', '=', 'city.id')
            ->leftJoin('district', 'manage_events.district_id', '=', 'district.districtid')
            ->leftJoin('state', 'manage_events.state_id', '=', 'state.state_id')
            ->where('manage_events.id', $id)
            ->first();

        if ($event) {
            $event->event_banner_url = asset('storage/' . $event->event_banner);

            return response()->json([
                'data' => $event,
                'code' => 200,
                'message' => 'Event fetched successfully'
            ]);
        }

        return response()->json([
            'data' => null,
            'code' => 404,
            'message' => 'Event not found'
        ]);
    }
}
