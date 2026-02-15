<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $categories = \App\Models\Category::where('status', true)->with(['menuItems' => function($query) {
            $query->where('status', true);
        }])->get();
        
        return view('public.menu', compact('categories'));
    }
}
