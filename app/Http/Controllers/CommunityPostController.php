<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Community;
use App\Models\Post;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CommunityPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Community $community
     * @return Application|Factory|View
     */
    public function index(Community $community)
    {
        $posts = $community->posts()->latest()->paginate(10);

        return view('communities.post.index', compact('community', 'posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Community $community
     * @return Application|Factory|View
     */
    public function create(Community $community)
    {
        return view('posts.create', compact('community'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePostRequest $request
     * @param Community $community
     * @return RedirectResponse
     */
    public function store(StorePostRequest $request, Community $community)
    {
        $community->posts()->create([
            "user_id" => auth()->id(),
            "title" => $request->title,
            "post_text" => $request->post_text,
            "post_url" => $request->post_url,
        ]);

        return redirect()->route('communities.show', compact('community'));
    }

    /**
     * Display the specified resource.
     *
     * @param Community $community
     * @param Post $post
     * @return Application|Factory|View
     */
    public function show(Community $community, Post $post)
    {
        return view('posts.show', compact('post','community'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
