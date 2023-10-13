<?php

namespace App\Http\Controllers\Event;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventLocationRequest;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventLocation;

class EventLocationController extends Controller
{
    public function save(EventLocationRequest $request, $id)
    {
        $event = Event::findOrFail($id);

        if ($event->location) {
            $event->location->update([
                'zip_code' => $request->input('zip_code'),
                'city' => $request->input('city'),
                'state' => $request->input('state'),
                'street' => $request->input('street'),
                'number' => $request->input('number'),
                'complement' => $request->input('complement'),
                'google_maps_link' => $request->input('google_maps_link')
            ]);
        } else {
            EventLocation::create([
                'event_id' => $id,
                'zip_code' => $request->input('zip_code'),
                'city' => $request->input('city'),
                'state' => $request->input('state'),
                'street' => $request->input('street'),
                'number' => $request->input('number'),
                'complement' => $request->input('complement'),
                'google_maps_link' => $request->input('google_maps_link')
            ]);
        }
    }
}
