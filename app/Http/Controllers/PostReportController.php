<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostReport;
use Illuminate\Http\Request;

class PostReportController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'reported_reason' => 'required|string|max:255',
        ]);

        PostReport::create([
            'user_id' => auth()->id(),
            'post_id' => $post->post_id,
            'reported_reason' => $request->reported_reason,
            'reported_at' => now(),
        ]);

        return redirect()->back()->with('success', 'El post ha sido reportado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(PostReport $postReport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PostReport $postReport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PostReport $postReport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PostReport $postReport)
    {
        //
    }
}
