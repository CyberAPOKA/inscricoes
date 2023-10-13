<?php

namespace App\Http\Controllers\Event;

use App\Http\Controllers\Controller;
use App\Models\InscriptionLot;
use Illuminate\Http\Request;
use App\Models\EventInscription;

class EventLotController extends Controller
{
    public function create(Request $request, $id)
    {
        $data = $request->all();

        InscriptionLot::create([
            'event_inscription_id' => $id,
            'name' => $data['name'],
            'start_date' => $data['start_date'],
            'start_hour' => $data['start_hour'],
            'end_date' => $data['end_date'],
            'end_hour' => $data['end_hour'],
        ]);

        if ($data['add_lot_to_all_subscriptions'] === 'yes') {

            $inscription = EventInscription::find($id);
            $eventId = $inscription->event_id;

            $allInscriptionsForEvent = EventInscription::where('event_id', $eventId)->get();

            foreach ($allInscriptionsForEvent as $eventInscription) {
                if ($eventInscription->id != $id) {
                    InscriptionLot::create([
                        'event_inscription_id' => $eventInscription->id,
                        'name' => $data['name'],
                        'start_date' => $data['start_date'],
                        'start_hour' => $data['start_hour'],
                        'end_date' => $data['end_date'],
                        'end_hour' => $data['end_hour'],
                    ]);
                }
            }
        }
    }


    public function edit(Request $request, $id)
    {
        // dd($request);

        $lot = InscriptionLot::findOrFail($id);

        $lot->update([
            'name' => $request->name,
            'start_date' => $request->start_date,
            'start_hour' => $request->start_hour,
            'end_date' => $request->end_date,
            'end_hour' => $request->end_hour,
        ]);
    }

    public function delete($id)
    {
        $lot = InscriptionLot::findOrFail($id);
        $lot->delete();
    }
}
