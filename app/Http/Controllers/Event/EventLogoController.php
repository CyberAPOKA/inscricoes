<?php

namespace App\Http\Controllers\Event;

use App\Http\Controllers\Controller;
use App\Models\EventLogo;
use App\Models\LogoInfo;
use Illuminate\Http\Request;

class EventLogoController extends Controller
{

    public function photoMove(Request $request, $id)
    {
        $oldIndex = $request->get('oldIndex');
        $newIndex = $request->input('newIndex');
        $status = $request->input('itemStatus');
        $item = $request->input('item');
        $event_logo_id = $request->input('event_logo_id');


        if ($status === "moved") {
            $currentItem = LogoInfo::where('event_logo_id', $event_logo_id)
                ->where('index', $oldIndex)
                ->first();
            if ($oldIndex > $newIndex) {
                LogoInfo::where('event_logo_id', $event_logo_id)
                    ->whereBetween('index', [$newIndex, $oldIndex - 1])
                    ->increment('index', 1);
            } elseif ($oldIndex < $newIndex) {
                LogoInfo::where('event_logo_id', $event_logo_id)
                    ->whereBetween('index', [$oldIndex + 1, $newIndex])
                    ->decrement('index', 1);
            }
            $currentItem->update([
                'index' => $newIndex,
            ]);
        } else {
            $oldIndexAdded = $item['element']['index'];
            $newIndexAdded = $item['newIndex'];
            $oldFileTypeAdded = $item['element']['parent']['file_type'];
            $newFileTypeAdded = $request->get('file_type');
            $currentLogo = EventLogo::find($item['element']['parent']['id']);

            $newLogo = EventLogo::where('event_id', $currentLogo->event_id)
                ->where('file_type', $newFileTypeAdded)
                ->first();

            if (!$newLogo) {
                throw new Exception('Erro interno');
            }

            $currentItem = LogoInfo::where('event_logo_id', $currentLogo->id)
                ->where('index', $oldIndexAdded)
                ->first();

            if (!$currentItem) {
                throw new Exception('Erro interno');
            }

            if ($oldFileTypeAdded !== $newFileTypeAdded) {

                LogoInfo::where('event_logo_id', $currentLogo->id)
                    ->where('index', '>', $oldIndexAdded)
                    ->decrement('index');

                LogoInfo::where('event_logo_id', $newLogo->id)
                    ->where('index', '>=', $newIndexAdded)
                    ->increment('index');
            } else {
                if ($oldIndexAdded > $newIndexAdded) {
                    LogoInfo::where('event_logo_id', $currentLogo->id)
                        ->where('index', '>=', $newIndexAdded)
                        ->where('index', '<', $oldIndexAdded)
                        ->increment('index');
                } else {
                    LogoInfo::where('event_logo_id', $currentLogo->id)
                        ->where('index', '>', $oldIndexAdded)
                        ->where('index', '<=', $newIndexAdded)
                        ->decrement('index');
                }
            }
            $currentItem->update([
                'index' => $newIndexAdded,
                'event_logo_id' => $newLogo->id,
            ]);
        }
    }

    public function logoDelete(Request $request)
    {
        $logoId = $request->input('logo_id');

        $logo = LogoInfo::where('id', $logoId)->first();

        if (!$logo) {
            return redirect()->back()->with('error', 'Erro interno');
        }

        $deletedLogoIndex = $logo->index;

        $logo->delete();

        LogoInfo::where('event_logo_id', $logo->event_logo_id)
            ->where('index', '>', $deletedLogoIndex)
            ->decrement('index');
    }

    public function rowDelete(Request $request)
    {
        $groupId = $request->input('group_id');

        $row = EventLogo::where('id', $groupId)->first();

        if (!$row) {
            return redirect()->back()->with('error', 'Erro interno');
        }

        $deletedRowIndex = $row->index;

        $row->delete();

        EventLogo::where('index', '>', $deletedRowIndex)
            ->decrement('index');
    }

    public function dragMoveMobile(Request $request, $id)
    {
        $index = $request->input('group_index');
        $action = $request->input('action');

        $currentLogo = EventLogo::where('event_id', $id)->where('index', $index)->first();

        if ($action == 'up') {
            $logoAbove = EventLogo::where('event_id', $id)->where('index', '<', $index)->orderBy('index', 'desc')->first();
            if ($logoAbove) {
                $currentLogo->update(['index' => $logoAbove->index]);
                $logoAbove->update(['index' => $index]);
            }
        } elseif ($action == 'down') {
            $logoBelow = EventLogo::where('event_id', $id)->where('index', '>', $index)->orderBy('index', 'asc')->first();
            if ($logoBelow) {
                $currentLogo->update(['index' => $logoBelow->index]);
                $logoBelow->update(['index' => $index]);
            }
        }
    }

    public function dragMove(Request $request)
    {
        foreach ($request->input('mutableGroupedLogos') as $index => $group) {
            EventLogo::where('id', $group['id'])
                ->update(['index' => $index]);
        }
    }

    public function save(Request $request, $id)
    {
        $file = $request->file('image');
        if (!$file) {
            return;
        }
        $file_path = $file->store('public/graphic-material/sponsor/' . $id);
        $file_path = str_replace('public/', '', $file_path);

        $existingEventLogo = EventLogo::where('file_type', $request->input('file_type'))
            ->where('event_id', $id)
            ->first();

        if (!$existingEventLogo) {
            $lastIndex = EventLogo::where('event_id', $id)->max('index');
            $nextIndex = $lastIndex !== null ? $lastIndex + 1 : 0;

            $eventLogo = EventLogo::create([
                'event_id' => $id,
                'file_type' => $request->input('file_type'),
                'index' => $nextIndex
            ]);
        } else {
            $eventLogo = $existingEventLogo;
        }

        $lastIndex = $eventLogo->info()->max('index');

        $nextIndex = $lastIndex !== null ? $lastIndex + 1 : 0;

        LogoInfo::create([
            'event_logo_id' => $eventLogo->id,
            'file_name' => $file->getClientOriginalName(),
            'file_path' => $file_path,
            'index' => $nextIndex,
        ]);
    }


    public function saveLogoInRow(Request $request, $id)
    {
        // dd($request->get('data'));
        $file_type = $request->get('data');
        $file = $request->file('image');
        $file_path = $file->store('public/graphic-material/sponsor/' . $id);
        $file_path = str_replace('public/', '', $file_path);

        $existingEventLogo = EventLogo::where('file_type', $file_type)
            ->where('event_id', $id)
            ->first();

        if (!$existingEventLogo) {
            $lastIndex = EventLogo::where('event_id', $id)->max('index');
            $nextIndex = $lastIndex !== null ? $lastIndex + 1 : 0;

            $eventLogo = EventLogo::create([
                'event_id' => $id,
                'file_type' => $file_type,
                'index' => $nextIndex
            ]);
        } else {
            $eventLogo = $existingEventLogo;
        }

        $lastIndex = $eventLogo->info()->max('index');

        $nextIndex = $lastIndex !== null ? $lastIndex + 1 : 0;

        LogoInfo::create([
            'event_logo_id' => $eventLogo->id,
            'file_name' => $file->getClientOriginalName(),
            'file_path' => $file_path,
            'index' => $nextIndex,
        ]);
    }
}
