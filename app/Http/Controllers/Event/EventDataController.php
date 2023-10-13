<?php

namespace App\Http\Controllers\Event;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventData;
use App\Core\Constants\OneMoreDay;
use App\Http\Requests\EventRequest;
use App\Models\EventRegulation;
use Illuminate\Support\Facades\Auth;

class EventDataController extends Controller
{
    public function save(EventRequest $request, $id = null)
    {

        $user = Auth::user();
        if (!empty($id)) {
            $event = Event::findOrFail(!empty($id));
            $event->update([
                'user_id' => $user->id,
                'name' => $request->input('name'),
            ]);

            $one_more_day = $request->input('one_more_day');

            if ($one_more_day === null) {
                $one_more_day = OneMoreDay::NO;
            } else {
                $one_more_day = OneMoreDay::YES;
            }

            $event->data->update([
                'event_id' => $event->id,
                'organizer' => $request->input('organizer'),
                'category' => $request->input('category'),
                'date' => $request->input('date'),
                'hour' => $request->input('hour'),
                'one_more_day' => $one_more_day,
                'final_date' => $request->input('final_date'),
                'final_hour' => $request->input('final_hour'),
                'start_disclosure_date' => $request->input('start_disclosure_date'),
                'start_disclosure_hour' => $request->input('start_disclosure_hour'),
                'end_disclosure_date' => $request->input('end_disclosure_date'),
                'end_disclosure_hour' => $request->input('end_disclosure_hour'),
                'description' => $request->input('description'),
                'terms_and_conditions' => $request->input('terms_and_conditions'),
                'observation' => $request->input('observation'),
                'maximum_amount_tickets' => $request->input('maximum_amount_tickets'),
            ]);
        } else {
            $event = Event::create([
                'user_id' => $user->id,
                'name' => $request->input('name'),
            ]);

            $one_more_day = $request->input('one_more_day');

            if ($one_more_day === null) {
                $one_more_day = OneMoreDay::NO;
            } else {
                $one_more_day = OneMoreDay::YES;
            }

            EventData::create([
                'event_id' => $event->id,
                'organizer' => $request->input('organizer'),
                'category' => $request->input('category'),
                'date' => $request->input('date'),
                'hour' => $request->input('hour'),
                'one_more_day' => $one_more_day,
                'final_date' => $request->input('final_date'),
                'final_hour' => $request->input('final_hour'),
                'start_disclosure_date' => $request->input('start_disclosure_date'),
                'start_disclosure_hour' => $request->input('start_disclosure_hour'),
                'end_disclosure_date' => $request->input('end_disclosure_date'),
                'end_disclosure_hour' => $request->input('end_disclosure_hour'),
                'description' => $request->input('description'),
                'terms_and_conditions' => $request->input('terms_and_conditions'),
                'observation' => $request->input('observation'),
                'maximum_amount_tickets' => $request->input('maximum_amount_tickets'),
            ]);

            function processUpload($file, $event)
            {
                if ($file) {
                    $eventFile = new EventRegulation();
                    $eventFile->event_id = $event->id;
                    $eventFile->file_name = $file->getClientOriginalName();
                    $eventFile->file_path = $file->store('regulations/' . $event->id);

                    $eventFile->save();
                }
            }

            processUpload($request->file('regulation'), $event, 'regulation');
        }

        // return to_route('event', $event->id);
        // return redirect()->route('event', $event->id);
        return response()->json([
            'redirectUrl' => route('event', $event->id)
        ]);
    }

    public function regulationUpload(Request $request, $id = null)
    {
        $file = $request->file('regulation');

        $event = Event::findOrFail($id);

        EventRegulation::firstOrCreate(
            ['event_id' => $event->id],
            [
                'file_name' => $file->getClientOriginalName(),
                'file_path' => $file->store('regulations/' . $event->id),
            ]
        );
    }

    public function regulationDelete($id)
    {
        $regulation = EventRegulation::findOrFail($id);

        $regulation->delete();
    }
}
