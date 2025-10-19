<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    // Get all rooms
    public function index(Request $request)
    {
        $query = Room::query();

        if ($request->location) {
            $query->where('location', 'like', "%{$request->location}%");
        }
        if ($request->guests) {
            $query->where('guests', '>=', $request->guests);
        }

        return response()->json($query->get());
    }

    // Get single room
    public function show($id)
    {
        $room = Room::findOrFail($id);
        return response()->json($room);
    }
}
