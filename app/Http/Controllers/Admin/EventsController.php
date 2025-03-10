<?php

namespace App\Http\Controllers\Admin;

use App\Models\ManageEvent;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class EventsController extends Controller
{
    public function eventPage()
    {
        return view('Admin.Event.Create-Events');
    }
    public function eventCompletedPage()
    {
        return view('Admin.Event.Completed-Event');
    }

    public function eventListPage()
    {
        return view('Admin.Event.Event-List');
    }

    public function updateEventsPage($id)
    {
        return view('Admin.Event.Update-Event', ['id' => $id]);
    }

    public function eventDetailsPage($id)
    {
        return view('Admin.Event.Event-Details', ['id' => $id]);
    }

    public function stateList()
    {
        $states = DB::table('state')->get();
        return response()->json([
            'data' => $states,
            'code' => 200,
            'message' => 'States fetched successfully'
        ]);
    }
    public function districtList($state_id)
    {
        $districts = DB::table('district')->where('state_id', $state_id)->get();
        return response()->json([
            'data' => $districts,
            'code' => 200,
            'message' => 'Districts fetched successfully'
        ]);
    }
    public function citiesList($dist_id)
    {
        $cities = DB::table('city')->where('districtid', $dist_id)->get();
        return response()->json([
            'data' => $cities,
            'code' => 200,
            'message' => 'Cities fetched successfully'
        ]);
    }


    public function storeEvent(Request $request)
    {

        $validated = $request->validate([
            'event_title' => 'required|string|max:255',
            'event_date' => 'required|date',
            'state_id' => 'required|integer',
            'district_id' => 'required|integer',
            'city_id' => 'required|integer',
            'pincode' => 'required|string|max:10',
            'event_banner' => 'required|string', // Validation for Base64 string
            'total_tickets' => 'required|integer',
        ]);

        // Validate and store the event_banner (Base64 image)
        if (preg_match('/^data:image\/(jpeg|png);base64,/', $request->event_banner)) {
            // Extract the image data (without the prefix)
            $imageData = substr($request->event_banner, strpos($request->event_banner, ',') + 1);
            $imageData = base64_decode($imageData);

            // Generate a unique file name based on timestamp and random string
            $imageName = 'Eventimg/' . time() . '_' . Str::random(10) . '.png';

            // Store the image in the Eventimg folder
            Storage::disk('public')->put($imageName, $imageData);
        } else {
            // If the image is not in a valid base64 format, throw an error
            return response()->json(['error' => 'Invalid image format'], 400);
        }

        // Create a new event record
        $event = ManageEvent::create([
            'event_code' => uniqid('event_'),
            'event_title' => $validated['event_title'],
            'event_date' => $validated['event_date'],
            'state_id' => $validated['state_id'],
            'district_id' => $validated['district_id'],
            'city_id' => $validated['city_id'],
            'pincode' => $validated['pincode'],
            'event_banner' =>  $imageName,
            'total_tickets' => $validated['total_tickets'],
            'event_desc' => $request->event_desc,
            'status' => 1,

        ]);

        // Return a success response
        return response()->json([
            'message' => 'Event created successfully',
            'event' => $event,
            'success' => true,
        ], 201);
    }

    public function getAllEvents()
    {
        $events = ManageEvent::where('status', '!=', '2')->get();

        foreach ($events as $event) {
            $event->event_banner_url = asset('storage/' . $event->event_banner);
        }

        return response()->json([
            'data' => $events,
            'code' => 200,
            'message' => 'Events fetched successfully'
        ]);
    }

    public function getCompletedEvents()
    {
        $events = ManageEvent::where('status', '2')->get();

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

    public function updateEvent(Request $request, $id)
    {
        $validated = $request->validate([
            'event_title' => 'required|string|max:255',
            'event_date' => 'required|date',
            'state_id' => 'required|integer',
            'district_id' => 'required|integer',
            'city_id' => 'required|integer',
            'pincode' => 'required|string|max:10',
            'total_tickets' => 'required|integer',
        ]);

        $event = ManageEvent::find($id);

        if ($request->has('event_banner') && preg_match('/^data:image\/(jpeg|png);base64,/', $request->event_banner)) {
            $imageData = substr($request->event_banner, strpos($request->event_banner, ',') + 1);
            $imageData = base64_decode($imageData);
            Storage::disk('public')->put($event->event_banner, $imageData);
        }

        $event->update([
            'event_title' => $validated['event_title'],
            'event_date' => $validated['event_date'],
            'state_id' => $validated['state_id'],
            'district_id' => $validated['district_id'],
            'city_id' => $validated['city_id'],
            'pincode' => $validated['pincode'],
            'total_tickets' => $validated['total_tickets'],
            'event_desc' => $request->event_desc,
        ]);

        return response()->json([
            'message' => 'Event updated successfully',
            'event' => $event,
            'success' => true,
        ], 200);
    }

    public function statusEvent(Request $request,$id )
    {
        $event = ManageEvent::find($id);
        if ($event) {
            $event->status = $request->status;
            $event->save();
            return response()->json([
                'message' => 'Event status Updated successfully',
                'event' => $event,
                'success' => true,
            ], 200);
        }
        return response()->json([
            'data' => null,
            'code' => 404,
            'message' => 'Event not found'
        ]);
    }
}
