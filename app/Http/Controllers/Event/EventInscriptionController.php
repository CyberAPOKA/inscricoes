<?php

namespace App\Http\Controllers\Event;

use App\Http\Controllers\Controller;
use App\Models\EventInscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventInscriptionController extends Controller
{
    public function order(Request $request)
    {
        // dd($request->all());
        $inscriptions = $request->input('inscriptions');

        foreach ($inscriptions as $inscriptionData) {
            EventInscription::where('id', $inscriptionData['id'])
                ->update(['index' => $inscriptionData['index']]);
        }
    }

    public function orderMobile($id, Request $request)
    {
        $inscription = EventInscription::findOrFail($id);
        $current_index = $inscription->index;

        if ($request->action == 'up' && $current_index > 0) {
            $previous_inscription = EventInscription::where('index', $current_index - 1)->first();

            if ($previous_inscription) {
                $inscription->index = $current_index - 1;
                $inscription->save();

                $previous_inscription->index = $current_index;
                $previous_inscription->save();
            }
        } elseif ($request->action == 'down') {

            $next_inscription = EventInscription::where('index', $current_index + 1)->first();

            if ($next_inscription) {

                $inscription->index = $current_index + 1;
                $inscription->save();

                $next_inscription->index = $current_index;
                $next_inscription->save();
            }
        }
    }


    public function create(Request $request, $id)
    {
        // $lastIndex = EventInscription::where('event_id', $id)->max('index');
        // $index = is_null($lastIndex) ? 0 : $lastIndex + 1;

        DB::table('event_inscriptions')
            ->where('event_id', $id)
            ->increment('index');

        EventInscription::create([
            'event_id' => $id,
            'name' => $request->name,
            'participants' => $request->participants,
            'modality' => $request->modality,
            'restrictions' => $request->restrictions,
            // 'index' => $index
            'index' => 0
        ]);
    }

    public function delete($id)
    {
        $inscription = EventInscription::findOrFail($id);
        $inscription->delete();
    }

    public function duplicate($id)
    {
        $originalInscription = EventInscription::findOrFail($id)->load('lots');

        EventInscription::where('event_id', $originalInscription->event_id)
            ->increment('index');

        $newInscription = $originalInscription->replicate();
        $newInscription->index = 0;
        $newInscription->save();


        foreach ($originalInscription->lots as $lot) {
            $newLot = $lot->replicate(['event_inscription_id']);
            $newLot->event_inscription_id = $newInscription->id;
            $newLot->save();
        }
    }

    public function edit(Request $request, $id)
    {
        $inscription = EventInscription::findOrFail($id);

        $inscription->update([
            'name' => $request->name,
            'participants' => $request->participants,
            'modality' => $request->modality,
            'restrictions' => $request->restrictions,
        ]);
    }
}
