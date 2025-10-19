<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Create new booking
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'name' => 'required|string',
            'email' => 'required|email',
            'room_id' => 'required|integer',
            'price' => 'required|numeric',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after_or_equal:check_in',
        ]);

        $booking = Booking::create([
            'user_id' => optional($request->user())->id,
            'title' => $request->title,
            'name' => $request->name,
            'email' => $request->email,
            'room_id' => $request->room_id,
            'price' => $request->price,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
        ]);

        return response()->json([
            'message' => 'Booking created successfully',
            'booking' => $booking,
        ]);
    }

    /**
     * Get recent bookings for a user
     */
    public function recentBookings(Request $request)
    {
        $email = optional($request->user())->email ?? $request->query('email');

        if (!$email) {
            return response()->json(['message' => 'Email is required'], 400);
        }

        $bookings = Booking::with('room')
            ->where('email', $email)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return response()->json($bookings);
    }

    /**
     * Show a booking details by id
     */
    public function show($id)
    {
        $booking = Booking::with('room')->find($id);

        if (!$booking) {
            return response()->json(['message' => 'Booking not found'], 404);
        }

        return response()->json($booking);
    }
}
