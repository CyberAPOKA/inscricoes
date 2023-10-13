<?php

namespace App\Http\Controllers\Event;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventInscription;
use App\Models\EventKit;
use App\Models\KitInscription;
use App\Models\KitProduct;
use App\Models\ProductVariation;
use App\Models\EventProduct;
use Illuminate\Support\Facades\Log;

class EventKitController extends Controller
{
    public function have(Request $request, $id)
    {
        // dd($request->have_kit);
        Event::findOrFail($id)->update(['has_products_and_kits' => $request->has_products_and_kits]);
    }

    public function create(Request $request, $id)
    {
        $imageName = null;
        $imagePath = null;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = $file->getClientOriginalName();
            $imagePath = $file->store('public/kit/' . $id);
            $imagePath = str_replace('public/', '', $imagePath);
        }

        $kit = EventKit::create([
            'event_id' => $id,
            'name' => $request->input('name'),
            'observation' => $request->input('observation'),
            'athletes_amount' => $request->input('athletes_amount'),
            'image_name' => $imageName,
            'image_path' => $imagePath,
        ]);
        // dd($request->inscriptions);

        //era usado para relacionar kits e inscrições.
        // foreach ($request->inscriptions as $inscription) {
        //     $lastIndex = KitInscription::where('event_inscription_id', $inscription)
        //         ->max('index');

        //     $index = is_null($lastIndex) ? 0 : $lastIndex + 1;

        //     KitInscription::create([
        //         'event_kit_id' => $kit->id,
        //         'event_inscription_id' => $inscription,
        //         'index' => $index
        //     ]);
        // }
    }

    public function deleteImage($id)
    {
        $kit = EventKit::findOrFail($id);

        $kit->update([
            'image_name' => null,
            'image_path' => null,
        ]);
    }

    public function updateImage(Request $request, $id)
    {
        $kit = EventKit::findOrFail($id);

        $file = $request->file('file');

        $imageName = $file->getClientOriginalName();
        $imagePath = $file->store('public/kit/' . $id);
        $imagePath = str_replace('public/', '', $imagePath);

        $kit->update([
            'image_name' => $imageName,
            'image_path' => $imagePath,
        ]);
    }

    public function edit(Request $request, $id)
    {
        $kit = EventKit::findOrFail($id);

        $kit->update([
            'name' => $request->input('name'),
            'observation' => $request->input('observation'),
            'athletes_amount' => $request->input('athletes_amount'),
        ]);

        //era usado para atualizar a relação entre kits e inscrições.
        // $kit->inscriptions()->delete();
        // foreach ($request->inscriptions as $inscription) {
        //     $lastIndex = KitInscription::where('event_inscription_id', $inscription)
        //         ->max('index');

        //     Log::info('Edit - Inscription ID: ' . $inscription . ', Last Index: ' . $lastIndex);

        //     $index = is_null($lastIndex) ? 0 : $lastIndex + 1;

        //     KitInscription::create([
        //         'event_kit_id' => $kit->id,
        //         'event_inscription_id' => $inscription,
        //         'index' => $index
        //     ]);
        // }
    }


    public function delete($id)
    {
        // dd($id);

        $kit = EventKit::findOrFail($id);

        $kit->delete();
    }

    public function duplicate(Request $request, $id)
    {
        // dd($request->all(), $id);

        $kit = EventKit::create([
            'event_id' => $id,
            'name' => $request->kit['name'],
            'observation' => $request->kit['observation'],
            'amount' => $request->kit['amount'],
            'image_name' => $request->kit['image_name'],
            'image_path' => $request->kit['image_path']
        ]);

        //era usado para relacionar os kits e inscrições já existentes para uma nova cópia.
        // foreach ($request->kit['inscriptions'] as $inscription) {
        //     $lastIndex = KitInscription::where('event_inscription_id', $inscription['event_inscription_id'])
        //         ->max('index');
        //     $index = is_null($lastIndex) ? 0 : $lastIndex + 1;

        //     KitInscription::create([
        //         'event_kit_id' => $kit->id,
        //         'event_inscription_id' => $inscription['event_inscription_id'],
        //         'index' => $index
        //     ]);
        // }

        foreach ($request->kit['products'] as $productData) {
            $newProduct = EventProduct::create([
                'event_id' => $id,
                'name' => $productData['product']['name'],
                'maximum_amount' => $productData['product']['maximum_amount'],
                'extra' => $productData['product']['extra']
            ]);

            KitProduct::create([
                'event_kit_id' => $kit->id,
                'event_product_id' => $newProduct->id
            ]);

            foreach ($productData['product']['variations'] as $variation) {
                ProductVariation::create([
                    'event_product_id' => $newProduct->id,
                    'variation' => $variation['variation'],
                    'amount' => $variation['amount']
                ]);
            }
        }
    }


    public function order(Request $request, $id)
    {
        foreach ($request->order as $inscriptionOrder) {
            $currentInscriptionId = $inscriptionOrder['inscription_id'];

            foreach ($inscriptionOrder['kit_ids'] as $index => $kitOrder) {
                $kitInscriptionId = $kitOrder['id'];

                KitInscription::where('id', $kitInscriptionId)
                    ->update([
                        'event_inscription_id' => $currentInscriptionId,
                        'index' => $index
                    ]);
            }
        }
    }

    public function relationProducts(Request $request, $id)
    {
        // dd($request->all());

        $kit = EventKit::findOrFail($id);

        $syncData = [];
        foreach ($request->input('productIds') as $productId) {
            $syncData[$productId] = ['quantity' => $request->input('quantities')[$productId] ?? 1];
        }

        $kit->products()->sync($syncData);
    }

    public function removeProduct(Request $request, $id)
    {
        // dd($request->all(), $id);

        $productId = $request->input('product_id');
        $kitId = $request->input('kit_id');

        KitProduct::where('event_product_id', $productId)
            ->where('event_kit_id', $kitId)
            ->delete();
    }
}
