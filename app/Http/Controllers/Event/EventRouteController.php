<?php

namespace App\Http\Controllers\Event;

use App\Http\Controllers\Controller;
use App\Models\EventRoute;
use App\Models\RouteInscription;
use Illuminate\Http\Request;

class EventRouteController extends Controller
{
    public function create(Request $request, $id)
    {

        // dd($request->all());

        $imageName = null;
        $imagePath = null;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = $file->getClientOriginalName();
            $imagePath = $file->store('public/route/' . $id);
            $imagePath = str_replace('public/', '', $imagePath);
        }

        $route = EventRoute::create([
            'event_id' => $id,
            'name' => $request->name,
            'observation' => $request->observation,
            'image_name' => $imageName,
            'image_path' => $imagePath,
            'link_embed' => $request->link_embed
        ]);

        foreach ($request->inscriptions as $inscription) {
            RouteInscription::create([
                'event_route_id' => $route->id,
                'event_inscription_id' => $inscription,
            ]);
        }
    }

    public function deleteImage($id)
    {
        $route = EventRoute::findOrFail($id);

        $route->update([
            'image_name' => null,
            'image_path' => null,
        ]);
    }

    public function updateImage(Request $request, $id)
    {
        // dd($id, $request->all());

        $route = EventRoute::findOrFail($id);

        $file = $request->file('file');

        $imageName = $file->getClientOriginalName();
        $imagePath = $file->store('public/route/' . $id);
        $imagePath = str_replace('public/', '', $imagePath);

        $route->update([
            'image_name' => $imageName,
            'image_path' => $imagePath
        ]);
    }

    public function resetFields($id)
    {
        $route = EventRoute::findOrFail($id);

        $route->update([
            'image_name' => null,
            'image_path' => null,
            'link_embed' => null
        ]);
    }

    public function edit(Request $request, $id)
    {
        // dd($request->input('inscriptions'));
        // dd($request->inscriptions);

        $route = EventRoute::findOrFail($id);

        $route->update([
            'name' => $request->name,
            'observation' => $request->observation,
            'link_embed' => $request->link_embed
        ]);

        $route->inscriptions()->delete();

        foreach ($request->inscriptions as $inscriptionId) {
            RouteInscription::create([
                'event_route_id' => $route->id,
                'event_inscription_id' => $inscriptionId
            ]);
        }
    }

    public function delete($id)
    {
        $route = EventRoute::findOrFail($id);

        $route->delete();
    }
}
