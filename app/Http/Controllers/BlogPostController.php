<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Movie;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBlogPostRequest;
use App\Http\Resources\BlogPostResource;

class BlogPostController extends Controller
{
    public function index(Request $request)
{
    $query = BlogPost::with('movie'); // Eager loading related movie

    // Filter by movie ID
    if ($request->has('movie_id')) {
        $query->where('movie_id', $request->movie_id);
    }

    // Filter by date (created_at)
    if ($request->has('date')) {
        $query->whereDate('created_at', $request->date);
    }

    // Paginate the results
    return BlogPostResource::collection($query->paginate(10));
}

    public function show(BlogPost $blogPost)
{
    return new BlogPostResource($blogPost->load('movie'));
}


    public function store(StoreBlogPostRequest $request)
{
    $validated = $request->validated();
    $blogPost = BlogPost::create($validated);

    return new BlogPostResource($blogPost->load('movie'));

    return response()->json([
        'message' => 'Blog post created successfully',
        'blog_post' => $blogPost
    ], 201);
}

public function update(StoreBlogPostRequest $request, BlogPost $blogPost)
{
    $validated = $request->validated();
    $blogPost->update($validated);
    return new BlogPostResource($blogPost->load('movies'));
    return response()->json([
        'message' => 'Blog post updated successfully',
        'blog_post' => $blogPost
    ]);
}

public function destroy(BlogPost $blogPost)
{
    $blogPost->delete();

    return response()->json([
        'message' => 'Blog post deleted successfully'
    ]);
}


}

