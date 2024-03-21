<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\Category;

class RestaurantController extends Controller
{
    public function index(Request $request)    
    {
        $keyword = $request->keyword;

        if ($request->category !== null) {
            $restaurants = Restaurant::where('category_id', $request->category)->paginate(15);
            $total_count = Restaurant::where('category_id', $request->category)->count();
            $category_id = Category::find($request->category);
        } else {
            $restaurans = Restaurant::paginate(15);
            $total_count = "";
            $category_id = null;
        }    
    }
}
