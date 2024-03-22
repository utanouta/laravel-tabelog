<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\Category;
use App\Models\Regular_holiday;


class RestaurantController extends Controller
{
    public function index(Request $request)
    {
        $restaurants = Restaurant::paginate(15); 
        
        $keyword = $request->keyword;

        if ($keyword !== null) {
            $restaurants = Restaurant::where('name', 'like', "%{$keyword}%")->paginate(15);
        } else {
            $restaurants = Restaurant::paginate(15);
        }
        $total = $restaurants->total();
 
        return view('admin.restaurants.index', compact('restaurants', 'keyword', 'total'));
    }

    public function show(Restaurant $restaurant) {
        return view('admin.restaurants.show', compact('restaurant'));
    }

    public function create(Category $categories)
    {
        $categories =Category::all();
        $regular_holidays =Regular_holiday::all();
        return view('admin.restaurants.create',compact('categories', 'regular_holidays'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'image | max:2048',
            'description' => 'required',
            'lowest_price' => 'required | integer | min:0 | lte:highest_price',
            'highest_price' => 'required | integer | min:0 | gte:lowest_price',
            'postal_code' => 'required|digits:7|numeric',
            'address' => 'required',
            'opening_time' =>'required | before:closing_time',
            'closing_time' =>'required | after:opening_time',
            'seating_capacity' => 'required | integer | min:0',
        ]);
        $restaurant = new Restaurant();
        $restaurant->name = $request->input('name');
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('public/restaurants');
            $restaurant->image = basename($image);
        } else {
            $restaurant->image = '';
        }
        
        $restaurant->name = $request->input('name');
        $restaurant->description = $request->input('description');
        $restaurant->lowest_price = $request->input('lowest_price');
        $restaurant->highest_price = $request->input('highest_price');
        $restaurant->postal_code = $request->input('postal_code');
        $restaurant->address = $request->input('address');
        $restaurant->opening_time = $request->input('opening_time');
        $restaurant->closing_time = $request->input('closing_time');
        $restaurant->seating_capacity = $request->input('seating_capacity');
        $restaurant->save();

        $category_ids = array_filter($request->input('category_ids'));
        $restaurant->categories()->sync($category_ids);

        $regular_holiday_ids = $request->input('regular_holiday_ids');
        $restaurant->regular_holidays()->sync($regular_holiday_ids);


        return redirect()->route('admin.restaurants.index')->with('flash_message', '店舗を登録しました。');
    }

    public function edit(Restaurant $restaurant)
    {

        $categories = Category::all();

        $category_ids = $restaurant->categories->pluck('id')->toArray();

        $regular_holidays = Regular_holiday::all();

        return view('admin.restaurants.edit', compact('restaurant','categories', 'category_ids', 'regular_holidays'));

    }

    public function update(Request $request, Restaurant $restaurant)
    {
       
        $request->validate([
            'name' => 'required',
            'image' => 'image | max:2048',
            'description' => 'required',
            'lowest_price' => 'required | integer | min:0 | lte:highest_price',
            'highest_price' => 'required | integer | min:0 | gte:lowest_price',
            'postal_code' => 'required|digits:7|numeric',
            'address' => 'required',
            'opening_time' =>'required | before:closing_time',
            'closing_time' =>'required | after:opening_time',
            'seating_capacity' => 'required | integer | min:0',
        ]);

        
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('public/restaurants');
            $restaurant->image = basename($image);
        };

        
        $restaurant->name = $request->input('name');
        $restaurant->description = $request->input('description');
        $restaurant->lowest_price = $request->input('lowest_price');
        $restaurant->highest_price = $request->input('highest_price');
        $restaurant->postal_code = $request->input('postal_code');
        $restaurant->address = $request->input('address');
        $restaurant->opening_time = $request->input('opening_time');
        $restaurant->closing_time = $request->input('closing_time');
        $restaurant->seating_capacity = $request->input('seating_capacity');
        $restaurant->save();

         $category_ids = array_filter($request->input('category_ids'));
        $restaurant->categories()->sync($category_ids);

        $regular_holiday_ids = $request->input('regular_holiday_ids');
        $restaurant->regular_holidays()->sync($regular_holiday_ids);

 
        return redirect()->route('admin.restaurants.show', $restaurant)->with('flash_message', '店舗を編集しました。');
    }

    public function destroy(Restaurant $restaurants) {
       
        $restaurants->delete();

        return redirect()->route('admin.restaurants.index')->with('flash_message', '店舗を削除しました。');
    }

}



