<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $totalOrders = \App\Models\Order::count();
        $totalRevenue = \App\Models\Order::where('payment_status', 'paid')->sum('total_amount');
        $reservationsToday = \App\Models\Reservation::whereDate('reservation_date', now()->today())->count();
        $totalMenuItems = \App\Models\MenuItem::count();

        // Weekly Sales Chart Data
        $salesData = \App\Models\Order::where('payment_status', 'paid')
            ->where('created_at', '>=', now()->subDays(6)->startOfDay())
            ->selectRaw('DATE(created_at) as date, SUM(total_amount) as total')
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->keyBy('date');

        $chartLabels = [];
        $chartValues = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $chartLabels[] = now()->subDays($i)->format('D'); // Mon, Tue, etc.
            $chartValues[] = $salesData->has($date) ? $salesData[$date]->total : 0;
        }

        return view('admin.dashboard', compact('totalOrders', 'totalRevenue', 'reservationsToday', 'totalMenuItems', 'chartLabels', 'chartValues'));
    }
}
