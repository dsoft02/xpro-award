<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $pageTitle = '';
        $categories = Category::all();
        return view('home', compact('pageTitle', 'categories'));
    }

    public function showCategory($id)
    {
        $category = Category::with('nominees.categories')->findOrFail($id);

        $categories = Category::orderByRaw("id = ? DESC", [$id])->get();

        foreach ($category->nominees as $nominee) {
            $nominee->vote_count = $nominee->votesInCategory($id);
        }

        return view('category', compact('category', 'categories'));
    }

    public function showWinners()
    {
        $categories = Category::with(['nominees' => function ($query) {
            $query->withCount('votes')
            ->orderBy('votes_count', 'desc');
        }])->get();

        return view('winners', compact('categories'));
    }

}
