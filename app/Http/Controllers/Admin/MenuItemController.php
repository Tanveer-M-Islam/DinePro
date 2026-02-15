<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class MenuItemController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $menuItems = MenuItem::with('category')
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                             ->orWhere('description', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10);
            
        $categories = Category::where('status', true)->get();

        return view('admin.menu-items.index', compact('menuItems', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $validated;
        $data['status'] = $request->boolean('status');
        $data['is_featured'] = $request->boolean('is_featured');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('menu-items', 'public');
        }

        MenuItem::create($data);

        return redirect()->route('admin.menu-items.index')->with('success', 'Menu Item created successfully.');
    }

    public function update(Request $request, MenuItem $menuItem)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $validated;
        $data['status'] = $request->boolean('status');
        $data['is_featured'] = $request->boolean('is_featured');

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($menuItem->image) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($menuItem->image);
            }
            $data['image'] = $request->file('image')->store('menu-items', 'public');
        }

        $menuItem->update($data);

        return redirect()->route('admin.menu-items.index')->with('success', 'Menu Item updated successfully.');
    }

    public function destroy(MenuItem $menuItem)
    {
        if ($menuItem->image) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($menuItem->image);
        }
        $menuItem->delete();
        return redirect()->route('admin.menu-items.index')->with('success', 'Menu Item deleted successfully.');
    }
}
