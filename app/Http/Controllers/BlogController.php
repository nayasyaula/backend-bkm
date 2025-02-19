<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Blog::where('status', 'published')->latest()->paginate(10);
        return response()->json($posts);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'user_id' => 'required|exists:users,id',
            'status' => 'required|in:draft,published'
        ]);

        $post = Blog::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'user_id' => $request->user_id,
            'status' => $request->status
        ]);

        return response()->json(['message' => 'Post created successfully', 'post' => $post]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $post = Blog::with(['categories'])->findOrFail($id);
        return response()->json($post);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $post = Blog::findOrFail($id);
        $post->update($request->all());

        return response()->json(['message' => 'Post updated successfully', 'post' => $post]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $post = Blog::findOrFail($id);
        $post->delete();

        return response()->json(['message' => 'Post deleted successfully']);
    }
}
