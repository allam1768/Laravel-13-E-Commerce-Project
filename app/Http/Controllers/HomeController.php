<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Slide;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $slides = Slide::where('status', true)->get();
        $categories = Category::where('is_popular', true)->get();
        $featuredProducts = Product::where('featured', true)->with('category')->take(8)->get();
        $latestProducts = Product::latest()->with('category')->take(8)->get();

        return view('home', compact('slides', 'categories', 'featuredProducts', 'latestProducts'));
    }
}
