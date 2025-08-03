<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Blog;

class ThemeController extends Controller
{
    public function index()
    {
        $blogs = Blog:: latest()->paginate(4);
             $SlideBlogs = Blog::latest()->take(5)->get();

        return view("theme.index", compact('blogs','SlideBlogs'));
    }

    public function category( $id)
    {
        $blogs = Blog::where('category_id', $id)->paginate(8);
        $categoryname =Category:: find($id)->name;
        return view("theme.category", compact('blogs', 'categoryname'));
    }

    public function contact()
    {
        return view("theme.contact");
    }


}
