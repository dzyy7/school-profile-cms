<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $latestPosts = Post::where('status', 'published')
                            ->latest()
                            ->take(2)
                            ->get();

        return view('admin.dashboard', [
            'count_guru'   => \App\Models\Teacher::count(),
            'count_admin'  => \App\Models\User::count(),
            'count_posts'  => \App\Models\Post::where('status','published')->count(),
            'latestPosts'  => $latestPosts, // Tambahkan baris ini
        ]);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}