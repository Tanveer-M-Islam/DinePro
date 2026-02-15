<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredItems = \App\Models\MenuItem::where('is_featured', true)->where('status', true)->take(6)->get();
        $reviews = \App\Models\CustomerReview::where('is_featured', true)->where('status', true)->take(3)->get();
        return view('public.home', compact('featuredItems', 'reviews'));
    }
}
