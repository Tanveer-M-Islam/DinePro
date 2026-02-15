<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomerReview;
use Illuminate\Http\Request;

class CustomerReviewController extends Controller
{
    public function index()
    {
        $reviews = \App\Models\CustomerReview::paginate(10);
        return view('admin.reviews.index', compact('reviews'));
    }

    public function create()
    {
        return view('admin.reviews.create');
    }

    public function store(\Illuminate\Http\Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'review' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'is_featured' => 'boolean',
            'status' => 'boolean',
        ]);

        \App\Models\CustomerReview::create($validated);

        return redirect()->route('admin.reviews.index')->with('success', 'Review created successfully.');
    }

    public function edit(\App\Models\CustomerReview $review)
    {
        return view('admin.reviews.edit', compact('review'));
    }

    public function update(\Illuminate\Http\Request $request, \App\Models\CustomerReview $review)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'review' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'is_featured' => 'boolean',
            'status' => 'boolean',
        ]);

        $review->update([
            'name' => $validated['name'],
            'review' => $validated['review'],
            'rating' => $validated['rating'],
            'is_featured' => $request->has('is_featured'),
            'status' => $request->has('status'),
        ]);

        return redirect()->route('admin.reviews.index')->with('success', 'Review updated successfully.');
    }

    public function destroy(\App\Models\CustomerReview $review)
    {
        $review->delete();
        return redirect()->route('admin.reviews.index')->with('success', 'Review deleted successfully.');
    }
}
