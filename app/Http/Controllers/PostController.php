<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // if (!Gate::allows('cansee-all-posts')) {
        //     abort(403);
        // }

        if ($request->user()->cannot('viewAny', Post::class)) {
            abort(403);
        }

        return view('posts', [
            'posts' => Post::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->user()->cannot('create', Post::class)) {
            abort(403);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Post $post)
    {
        // if (!Gate::allows('update-post', $post)) {
        //     abort(403);
        // }

        return view('posts-update', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        // if ($request->user()->cannot('update', $post)) {
        //     abort(403);
        // }

        Post::where('id', $post->id)->update([
            'title' => $request->post()['title'],
            'slug' => $request->post()['slug'],
            'user_id' => $request->post()['user_id'],
            'content' => $request->post()['content'],
        ]);

        return redirect('/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Post $post)
    {
        // if (!Gate::allows('destroy-post', $post)) {
        //     abort(403);
        // }

        if ($request->user()->cannot('delete', $post)) {
            abort(403);
        }

        $post->delete();

        return redirect('/posts')->with('success', 'Task deleted successfully');
    }
}
