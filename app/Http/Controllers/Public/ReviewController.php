<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = \App\Models\CustomerReview::where('is_featured', true)->where('status', true)->latest()->paginate(12);
        return view('public.reviews', compact('reviews'));
    }

    public function store(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'review' => ['required', 'string', function ($attribute, $value, $fail) {
                if (str_word_count($value) > 100) {
                    $fail('The '.$attribute.' must not exceed 100 words.');
                }
            }],
        ]);

        \App\Models\CustomerReview::create([
            'name' => $request->name,
            'rating' => $request->rating,
            'review' => $request->review,
            'is_featured' => false,
            'status' => true,
        ]);

        return redirect()->back()->with('success', 'Thank you for your review! It has been submitted for moderation.');
    }
}
