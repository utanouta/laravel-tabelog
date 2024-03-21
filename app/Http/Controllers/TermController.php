<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Terms;

class TermController extends Controller
{
    public function index()
    {
        $term = Terms::first();

        return view('terms.index', compact('term'));
    }
}
