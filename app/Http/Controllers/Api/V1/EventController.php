<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use App\Models\Book;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::with('book', 'user')->get();

        return EventResource::collection($events);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'type' => 'required',
            'event_date' => 'nullable|date',
        ]);

        $event = Event::create($validated);

        return new EventResource($event);
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        return new EventResource($event);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'type' => 'required',
            'event_date' => 'nullable|date',
        ]);

        $event->update($validated);

        return new EventResource($event);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        if (!$event) {
        return response()->json([
            'success' => false,
            'message' => 'Event not found',
        ], 404);
        }

        $event->delete();

        return response()->json([
            'success' => true,
            'message' => 'Event deleted successfully',
        ]);
    }

    /**
     * Get a list of resource from user_id.
     */
    public function getEventsByUserId(User $user)
    {
        if (!$user) {
        return response()->json([
            'success' => false,
            'message' => 'User not found',
        ], 404);
        }

        $events = $user->events()->with('book')->orderBy('event_date', 'desc')->get();

        return EventResource::collection($events);
    }

    /**
     * Get a list of resource from book_id.
     */
    public function getEventsByBookId(Book $book)
    {
        if (!$book) {
        return response()->json([
            'success' => false,
            'message' => 'Book not found',
        ], 404);
        }

        $events = $book->events()->with('book')->orderBy('event_date', 'desc')->get();

        return EventResource::collection($events);
    }
}
