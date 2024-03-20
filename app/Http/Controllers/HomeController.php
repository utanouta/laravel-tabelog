<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Restaurant;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $highly_rated_restaurants = Restaurant::take(6);

        $categories = Category::all();

        $new_restaurants = Restaurant::OrderBy('created_at', 'desc')->take(6);
 
        return view('home', compact('highly_rated_restaurants', 'categories', 'new_restaurants'));
    }
}
