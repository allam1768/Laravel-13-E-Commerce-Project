<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function dashboard(): View
    {
        $totalOrders = Order::count();
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalRevenue = Order::where('status', '!=', 'canceled')->sum('total');

        $recentOrders = Order::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalOrders',
            'totalProducts',
            'totalCategories',
            'totalRevenue',
            'recentOrders'
        ));
    }

    public function products(): View
    {
        $products = Product::with(['category', 'brand'])->latest()->paginate(10);
        return view('admin.products', compact('products'));
    }

    public function orders(): View
    {
        $orders = Order::with('orderItems')->latest()->paginate(10);
        return view('admin.orders', compact('orders'));
    }

    public function categories(): View
    {
        $categories = Category::withCount('products')->paginate(10);
        return view('admin.categories', compact('categories'));
    }
}
