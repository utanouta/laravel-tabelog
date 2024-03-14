<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Terms;
use App\Http\Controllers\Controller;
use App\Http\Requests\TermRequest;

class TermController extends Controller
{
    public function index()
    {
        $term = Terms::first();

        return view('admin.terms.index', compact('term'));
    }

    public function edit(Terms $term)
    {

        $term = new Terms;

        return view('admin.terms.edit', compact('term'));

    }

    public function update(TermRequest $request, Terms $content)
    {
        
        $content->$content = $request->input('content');
 
        return redirect()->route('admin.terms.index', $content)->with('flash_message', '利用規約を編集しました。');
    }
}
