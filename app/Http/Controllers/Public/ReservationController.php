<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function store(\Illuminate\Http\Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'reservation_date' => 'required|date|after:now',
            'guests' => 'required|string',
            'special_request' => 'nullable|string',
        ]);

        // Convert guest count to integer if needed or store as string
        $validated['guests'] = (int) filter_var($validated['guests'], FILTER_SANITIZE_NUMBER_INT) ?: 2;
        $validated['status'] = 'pending';

        \App\Models\Reservation::create($validated);

        return redirect()->back()->with('success', 'Reservation request submitted successfully! We will confirm shortly.');
    }
}
