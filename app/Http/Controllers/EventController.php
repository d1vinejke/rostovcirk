<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::latest()->paginate(10);
        return view('events.index', compact('events'));
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        try {
            $is_published = request()->get('is_published');

            if ($is_published == 'on') {
                $is_published = true;
            } else $is_published = false;

            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'event_date' => 'required|date',
                'location' => 'required|string|max:255',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            ]);

            $imagePath = $request->file('image')->store('events', 'public');

            Event::create([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'event_date' => $validated['event_date'],
                'location' => $validated['location'],
                'image_path' => $imagePath,
                'is_published' => $is_published
            ]);
        } catch (\Exception $exception) {
            echo $exception->getMessage();
            exit;
        }

        return redirect()->route('events.index')
            ->with('success', 'Событие успешно создано');
    }

    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $is_published = request()->get('is_published');

        if ($is_published == 'on') {
            $is_published = true;
        } else $is_published = false;

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'location' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $validated['is_published'] = $is_published;

        if ($request->hasFile('image')) {
            Storage::delete('public/' . $event->image_path);
            $imagePath = $request->file('image')->store('events', 'public');
            $validated['image_path'] = $imagePath;
        }

        $event->update($validated);

        return redirect()->route('events.index')
            ->with('success', 'Событие успешно обновлено');
    }

    public function destroy(Event $event)
    {
        Storage::delete('public/' . $event->image_path);
        $event->delete();

        return redirect()->route('events.index')
            ->with('success', 'Событие удалено');
    }
}
