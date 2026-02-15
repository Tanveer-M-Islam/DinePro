<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function create()
    {
        $categories = \App\Models\Category::with('menuItems')->get();
        return view('admin.orders.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'items' => 'required|array|min:1',
            'items.*.id' => 'required|exists:menu_items,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        $totalAmount = 0;
        $orderItemsData = [];

        foreach ($validated['items'] as $itemData) {
            $menuItem = \App\Models\MenuItem::find($itemData['id']);
            $price = $menuItem->price;
            $quantity = $itemData['quantity'];
            $subtotal = $price * $quantity;
            $totalAmount += $subtotal;

            $orderItemsData[] = [
                'menu_item_id' => $menuItem->id,
                'quantity' => $quantity,
                'price' => $price,
            ];
        }

        $order = Order::create([
            'customer_name' => $validated['customer_name'] ?? 'Walk-in Customer', // Default if empty
            'phone' => $validated['phone'],
            'total_amount' => $totalAmount,
            'status' => 'completed', // Default to completed for manual orders
            'payment_status' => 'paid', // Default to paid for manual orders
        ]);

        foreach ($orderItemsData as $data) {
            $order->orderItems()->create($data);
        }

        return redirect()->route('admin.orders.index')->with('success', 'Order created successfully.');
    }

    public function index(Request $request)
    {
        $status = $request->input('status');
        $search = $request->input('search');

        $orders = Order::with('orderItems.menuItem')
            ->when($status, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->when($search, function ($query, $search) {
                return $query->where('id', 'like', "%{$search}%")
                             ->orWhere('customer_name', 'like', "%{$search}%")
                             ->orWhere('phone', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        return response()->json($order->load('orderItems.menuItem'));
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('admin.orders.index')->with('success', 'Order deleted successfully.');
    }

    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled',
            'payment_status' => 'required|in:pending,paid,failed',
        ]);

        $order->update($validated);

        return redirect()->back()->with('success', 'Order updated successfully.');
    }
}
