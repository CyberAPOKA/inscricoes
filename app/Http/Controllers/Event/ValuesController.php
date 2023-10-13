<?php

namespace App\Http\Controllers\Event;

use App\Http\Controllers\Controller;
use App\Models\EventKit;
use App\Models\EventKitInscriptionLot;
use Illuminate\Http\Request;
use App\Models\InscriptionLot;
use App\Models\KitInscription;

class ValuesController extends Controller
{
    public function addWithKit(Request $request, $id)
    {
        // dd($request->all(), $id);

        // $lastIndex = KitInscription::where('event_inscription_id', $request->inscriptionId)->max('index');

        // $index = is_null($lastIndex) ? 0 : $lastIndex + 1;

        // KitInscription::create([
        //     'event_kit_id' => $request->kitId,
        //     'event_inscription_id' => $request->inscriptionId,
        //     'index' => $index
        // ]);

        if ($request->allLots === 'yes') {

            $lots = InscriptionLot::where('event_inscription_id', $request->inscriptionId)->get();

            foreach ($lots as $lot) {
                EventKitInscriptionLot::create([
                    'inscription_lot_id' => $lot->id,
                    'event_kit_id' => $request->kitId,
                    'athletes_amount' => $request->athletes_amount,
                    'vacancies_number' => $request->vacancies_number,
                    'value' => $request->value,
                    'senior_discount' => $request->senior_discount
                ]);
            }
        } else {
            EventKitInscriptionLot::create([
                'inscription_lot_id' => $id,
                'event_kit_id' => $request->kitId,
                'athletes_amount' => $request->athletes_amount,
                'vacancies_number' => $request->vacancies_number,
                'value' => $request->value,
                'senior_discount' => $request->senior_discount
            ]);
        }
    }

    public function addWithoutKit(Request $request, $id)
    {
        // dd($request->all(), $id);

        EventKitInscriptionLot::create([
            'inscription_lot_id' => $id,
            'athletes_amount' => $request->athletes_amount,
            'amount' => $request->amount,
            'value' => $request->value,
            'senior_discount' => $request->senior_discount
        ]);
    }

    public function kitLotDelete($id)
    {
        $item = EventKitInscriptionLot::findOrFail($id);

        $item->delete();
    }

    public function kitLotUpdate(Request $request, $id)
    {
        dd($request->all(), $id);

        $kit = EventKitInscriptionLot::findOrFail($id);
        $event_kid_id = $request->input('event_kid_id');
        if ($event_kid_id) {
            $kit->update([
                'amount' => $request->input('amount'),
                'value' => $request->input('value'),
                'senior_discount' => $request->input('senior_discount'),
            ]);
        } else {
            $kit->update([
                'amount' => $request->input('amount'),
                'value' => $request->input('value'),
                'senior_discount' => $request->input('senior_discount'),

                'athletes_amount',
                'vacancies_number',
                'amount',
                'value',
                'senior_discount'
            ]);
        }
    }
}
