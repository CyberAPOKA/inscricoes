<?php

namespace App\Http\Controllers\Event;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\EventGraphicMaterial;

class EventGraphicMaterialController extends Controller
{

    public function materialsUpload(Request $request, $id = null)
    {
        $type = $request->input('field');
        $file = $request->file('file');
        $event = Event::findOrFail($id);

        EventGraphicMaterial::create(
            [
                'event_id' => $event->id,
                'file_name' => $file->getClientOriginalName(),
                'file_path' => $file->store('materials/' . $event->id),
                'file_type' => $type
            ]
        );
    }

    public function materialsDelete($id)
    {
        $materials = EventGraphicMaterial::findOrFail($id);

        $materials->delete();
    }
}
