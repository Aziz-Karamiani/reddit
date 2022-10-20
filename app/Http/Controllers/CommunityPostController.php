<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Community;
use App\Models\Post;
use App\Models\PostVote;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;

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
        $post = $community->posts()->create([
            "user_id" => auth()->id(),
            "title" => $request->title,
            "post_text" => $request->post_text,
            "post_url" => $request->post_url,
        ]);

        // Upload post image if exists
        if ($request->hasFile('post_image')) {
            $imageName = $request->file('post_image')->getClientOriginalName();
            $request->file('post_image')->storeAs('posts/' . $post->id, $imageName);
            $post->update(["post_image" => $imageName]);
        }

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
        $post->load('comments.user');
        return view('posts.show', compact('post', 'community'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Community $community
     * @param Post $post
     * @return Application|Factory|View
     */
    public function edit(Community $community, Post $post)
    {
        if (Gate::denies('edit-post', $post))
            abort(403);

        return view('posts.edit', compact('post', 'community'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StorePostRequest $request
     * @param Community $community
     * @param Post $post
     * @return RedirectResponse
     */
    public function update(StorePostRequest $request, Community $community, Post $post)
    {
        if (Gate::denies('edit-post', $post))
            abort(403);

        $post->update($request->validated());

        // Upload post image if exists
        if ($request->hasFile('post_image')) {

            if ($post->post_image)
                unlink(storage_path("app/public/posts/{$post->id}/" . $post->post_image));

            $imageName = $request->file('post_image')->getClientOriginalName();
            $request->file('post_image')->storeAs('posts/' . $post->id, $imageName);
            $post->update(["post_image" => $imageName]);
        }

        return redirect()->route('communities.show', compact('community'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Community $community
     * @param Post $post
     * @return RedirectResponse
     */
    public function destroy(Community $community, Post $post)
    {
        if (Gate::denies('delete-post', $post))
            abort(403);

        $post->delete();

        return redirect()->route('communities.show', compact('community'));
    }

    /**
     * @param Post $post
     * @param int $vote
     * @return RedirectResponse
     */
    public function vote(Post $post, int $vote)
    {
        if ($post->user_id != auth()->id() && in_array($vote, [1, -1]) && !PostVote::where(['post_id' => $post->id, 'user_id' => auth()->id()])->exists()) {
            $post->votes()->create([
                'user_id' => auth()->id(),
                'vote' => $vote
            ]);
        }

        return redirect()->back();
    }
}
