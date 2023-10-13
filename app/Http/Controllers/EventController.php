<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Event;
use App\Models\EventProduct;
use App\Models\KitProduct;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\EventRequest;

class EventController extends Controller
{

    public function event($id)
    {
        $extraProducts = EventProduct::with('variations', 'products')
            ->where('event_id', $id)
            ->where('extra', 'yes')
            ->get();

        $products = EventProduct::with('variations', 'products')
            ->where('event_id', $id)
            ->get();

        $user = Auth::user();

        $event = Event::where('user_id', $user->id)->findOrFail($id)->load(
            [
                'data',
                'regulation',
                'location',
                'logos',
                'logos.info',
                'materials',
                'inscriptions',
                'products',
                'products.variations',
                'inscriptions.lots',
                'inscriptions.boleto',
                'inscriptions.pix',
                'inscriptions.creditCard',
                'inscriptions.lots.eventKits',
                'inscriptions.lots.eventKits.kit',
                'inscriptions.kits',
                'inscriptions.kits.kit',
                'inscriptions.kits.kit.products',
                'inscriptions.kits.kit.products.kit',
                'inscriptions.kits.kit.products.product',

                'routes',
                'routes.inscriptions',
                'routes.inscriptions.eventRoute',
                'routes.inscriptions.eventInscription',
                'kits',
                'kits.inscriptions',
                'kits.inscriptions.eventKit',
                'kits.inscriptions.eventInscription',
                'kits.products',
                'kits.products.products',
                // 'kits.products.products.variations'
            ]
        );

        return Inertia::render('Event', [
            'event' => $event,
            'extraProducts' => $extraProducts,
            'products' => $products
        ]);
    }

    public function create()
    {
        return Inertia::render('Event/Create');
    }

    public function index()
    {
        return Inertia::render('Events');
    }

    public function view()
    {
        return Inertia::render('Event/View');
    }

    public function eventSave(EventRequest $request)
    {
        $event = Event::create([
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

        return response()->json([
            'status' => 'success',
            'url' => route('event', $event->id),
        ]);
    }

    public function eventLocationSave(Request $request, $id)
    {
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

    public function eventGraphicMaterialsSave(Request $request, $id)
    {
        function processUploadGM($file, $id, $type)
        {
            if ($file) {
                $eventGraphicMaterial = new EventGraphicMaterial();
                $eventGraphicMaterial->event_id = $id;
                $eventGraphicMaterial->file_name = $file->getClientOriginalName();
                $eventGraphicMaterial->file_path = $file->store('graphic-material/' . $type . '/' . $id);
                $eventGraphicMaterial->file_type = $type;
                $eventGraphicMaterial->save();
            }
        }

        processUploadGM($request->file('main_banner'), $id, 'main_banner');
        processUploadGM($request->file('logo_event'), $id, 'logo_event');
        processUploadGM($request->file('calendar_banner'), $id, 'calendar_banner');
        processUploadGM($request->file('art_story'), $id, 'art_story');
        processUploadGM($request->file('art_feed'), $id, 'art_feed');

        // MÚLTIPLOS ARQUIVOS
        function processMultipleSponsorGM($sponsor, $id, $type)
        {
            if (!empty($sponsor)) {
                foreach ($sponsor as $file) {
                    if ($file) {
                        // $eventGraphicMaterial = new EventGraphicMaterial();
                        // $eventGraphicMaterial->event_id = $event->id;
                        // $eventGraphicMaterial->file_name = $file->getClientOriginalName();
                        // $file_path = $file->store('public/graphic-material/sponsor/' . $event->id);
                        // $file_path = str_replace('public/', '', $file_path);
                        // $eventGraphicMaterial->file_type = $type;
                        // $eventGraphicMaterial->save();

                        $file_path = $file->store('public/graphic-material/sponsor/' . $id);
                        $file_path = str_replace('public/', '', $file_path);

                        EventGraphicMaterial::create([
                            'event_id' => $id,
                            'file_name' => $file->getClientOriginalName(),
                            'file_path' => $file_path,
                            'file_type' => $type,
                        ]);
                    }
                }
            }
        }
        processMultipleSponsorGM($request->file('sponsor'), $id, 'sponsor');
    }

    public function crop()
    {
        return Inertia::render('Event/Partials/GitCrop');
    }

    public function drag()
    {
        return Inertia::render('Event/Partials/Drag');
    }

    public function teste()
    {
        $testes = Teste::all();
        return Inertia::render('Event/Partials/Teste', [
            'testes' => $testes
        ]);
    }

    public function testePost(Request $request)
    {
        Teste::create([
            'name' => $request->input('name')
        ]);
    }
}
