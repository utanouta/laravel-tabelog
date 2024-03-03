<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;


class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::paginate(15); 
        
        $keyword = $request->keyword;

        if ($keyword !== null) {
            $categories = Category::where('name', 'like', "%{$keyword}%")->paginate(15);
        } else {
            $categories = Category::paginate(15);
        }
        $total = $categories->total();
 
        return view('admin.categories.index', compact('categories', 'keyword', 'total'));
    }

    public function store(CategoryRequest $request)
    {
        $categories = new Category();
        $categories->name = $request->input('name');
        $categories->save();

        return redirect()->route('admin.categories.index')->with('flash_message', 'カテゴリを登録しました。');
    }

    public function update(CategoryRequest $request)
    {
        $categories = new Category();
        $categories->name = $request->input('name');
        $categories->save();

        return redirect()->route('admin.categories.index')->with('flash_message', 'カテゴリを編集しました。');
    }

    public function destroy(Category $categories) {
       
        $categories->delete();

        return redirect()->route('admin.categories.index')->with('flash_message', 'カテゴリを削除しました。');
    }
}    
