<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::when(Auth::check(), function ($query) {
            return $query->with(['reports' => function ($query) {
                $query->where('user_id', Auth::id());
            }]);
        })
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->paginate()
            ->through(function ($post) {
                $userId = Auth::id();

                // Check if post is editable by the user
                $post->canEdit = $userId && $post->user_id === $userId;

                // Check if post is reported by the user
                $post->canReport = $userId && $post->reports->isEmpty() && $post->user_id !== $userId;

                // Clean up any loaded relationships if not needed anymore
                unset($post->reports);

                return $post;
            });

        return view('posts.index', [
            'posts' => $posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'place' => 'required|string|max:255',
            'body' => 'required|string',
            'event_date' => 'required|date',
        ]);

        Post::create([
            'user_id' => 1,
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'place' => $validated['place'],
            'body' => $validated['body'],
            'event_date' => $validated['event_date'],
        ]);

        return redirect()->route('posts.my_posts')->with('success', 'Publicación realizada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // Display a success toast with no title
        $title = $post->title;
        $post->delete();
        return redirect()->back()->with('success', 'El post se ha eliminado correctamente');
    }

    public function report(Request $request, Post $post)
    {
        $request->validate([
            'reported_reason' => 'required|string|max:255',
        ]);

        PostReport::create([
            'user_id' => auth()->id(),
            'post_id' => $post->id,
            'reported_reason' => $request->reported_reason,
            'reported_at' => now(),
        ]);

        return redirect()->back()->with('success', 'El post ha sido reportado correctamente.');

    }

    public function my_posts(Request $request)
    {
        $posts = Post::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate()
            ->through(function ($post) {
                $post->canEdit = true;
                $post->canReport = false;
                return $post;
            });

        return view('posts.my_posts', [
            'posts' => $posts
        ]);
    }
}
