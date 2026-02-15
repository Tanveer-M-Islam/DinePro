<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->input('status');
        $date = $request->input('date');
        $search = $request->input('search');

        $reservations = Reservation::when($status, function ($query, $status) {
            return $query->where('status', $status);
        })
        ->when($date, function ($query, $date) {
            return $query->whereDate('reservation_date', $date);
        })
        ->when($search, function ($query, $search) {
             return $query->where('name', 'like', "%{$search}%")
                          ->orWhere('phone', 'like', "%{$search}%");
        })
        ->orderBy('reservation_date', 'asc')
        ->paginate(10);

        return view('admin.reservations.index', compact('reservations'));
    }

    public function update(Request $request, Reservation $reservation)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled',
        ]);

        $reservation->update($validated);

        return redirect()->back()->with('success', 'Reservation updated successfully.');
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return redirect()->route('admin.reservations.index')->with('success', 'Reservation deleted successfully.');
    }
}
