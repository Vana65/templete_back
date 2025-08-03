<?php

namespace App\Http\Controllers;
use App\Http\Requests\UpdateDataBlogRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreBlogRequest;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::check()) {
            $categories = Category::get();
            return view("theme.blogs.create", compact("categories"));
        } else {
            abort(403);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlogRequest $request)
    {
        $data = $request->validated();
        $image = $request->file('image');
        $newImageName = time() . '-' . $image->getClientOriginalName();
        $path = $request->file('image')->storeAs('blogs', $newImageName, 'public');
        $data['image'] = $newImageName;
        $data['user_id'] = Auth::user()->id;
        Blog::create($data);
        return back()->with("blogCreateStatus", "Blog Added Successfully");
    }



    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        return view("theme.singleblog", compact("blog"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        if ($blog->user_id == Auth::id()) {
 $categories = Category::get();
            return view("theme.blogs.editt", compact('categories','blog'));
        }
        abort(403);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDataBlogRequest $request, Blog $blog)
    {
        if (Auth::user()->id == $blog->user_id) {

            $data = $request->validated();
            if ($request->hasFile('image')) {
                Storage::delete('public/blogs/' . $blog->image);


                $image = $request->file('image');
                $newImageName = time() . '-' . $image->getClientOriginalName();
                $path = $request->file('image')->storeAs('blogs', $newImageName, 'public');
                $data['image'] = $newImageName;
            }
            $blog->update($data);
            return back()->with("blogUpdateStatus", "Updated Added Successfully");
        }
        abort(403);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
       
                     Storage::delete("public/blogs/" . $blog->image);

                        $blog->delete();
                        return back()->with("blogDeleteStatus", "Blog Deleted Successfully");

    }
    /**
     * display the specified resource from storage.
     */
    public function myBlogs()
    {
    if (!Auth::check()) {
        abort(403);
    }

        $blogs = Blog::where('user_id', Auth::user()->id)->paginate(10);
        return view("theme.blogs.my-blogs", compact('blogs'));
    }
}