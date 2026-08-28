<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\User;
use App\Models\Product;

class AdminDashboardController extends Controller
{
    /**
     * Display the Admin Dashboard with Categories, Users, and Products summaries.
     */
    public function index()
    {
        $categoriesCount = Category::count();
        $usersCount = User::count();
        $productsCount = Product::count();

        $categories = Category::latest()->take(10)->get();
        $users = User::select('id', 'name', 'email', 'role', 'created_at')->latest()->take(10)->get();
        $products = Product::with('category')->latest()->take(10)->get();

        return view('admin.dashboard', compact(
            'categoriesCount',
            'usersCount',
            'productsCount',
            'categories',
            'users',
            'products'
        ));
    }
}
