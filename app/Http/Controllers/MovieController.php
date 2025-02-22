<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use App\Http\Requests\StoreMovieRequest;
use App\Http\Resources\MovieResource;


class MovieController extends Controller
{
    
    public function index(Request $request)
{
    $query = Movie::with('genres'); // Eager loading genres

    // Filter by genre
    if ($request->has('genre')) {
        $query->whereHas('genres', function ($q) use ($request) {
            $q->where('name', $request->genre);
        });
    }

    // Filter by release date
    if ($request->has('release_date')) {
        $query->whereDate('release_date', $request->release_date);
    }

    // Paginate the results
    return MovieResource::collection($query->paginate(10));
}


    public function store(StoreMovieRequest $request) 
    {
        $validated = $request->validated();
        $movie = Movie::create($validated);
    
        if ($request->has('genres')) {
            $movie->genres()->attach($request->genres); // ✅ Attach genres
        }
        
        return new MovieResource($movie->load('genres'));

    }



    public function show(Movie $movie)
    {
        return new MovieResource($movie->load('genres', 'blogPosts'));
    }




    public function update(Request $request, Movie $movie)
    {
        $validated = $request->validate([
            'title' => 'sometimes|string',
            'description' => 'sometimes|string',
            'release_date' => 'sometimes|date',
            'genres' => 'array', // ✅ Allow updating genres
            'genres.*' => 'exists:genres,id', // ✅ Validate genre IDs
        ]);

        $movie->update($validated);

        if ($request->has('genres')) {
            $movie->genres()->sync($request->genres); // ✅ Update genres
        }

        return response()->json($movie->load('genres'));
    }



    
    public function destroy(Movie $movie)
    {
        $movie->delete();
        return response()->json(['message' => 'Movie deleted']);
    }
}
