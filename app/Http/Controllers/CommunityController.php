<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommunityRequest;
use App\Http\Requests\UpdateCommunityRequest;
use App\Models\Community;
use App\Models\Topic;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CommunityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $communities = Community::where("user_id", auth()->id())->get();

        return view("communities.index", compact('communities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $topics = Topic::all();
        return view('communities.create', compact('topics'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCommunityRequest $request
     * @return RedirectResponse
     */
    public function store(StoreCommunityRequest $request)
    {
        $community = Community::create($request->validated() + ["user_id" => auth()->id()]);

        $community->topics()->attach($request->topics);

        return redirect()->route('communities.index')->with(["message" => "Community Updated Successfully.", "class" => "success"]);
    }

    /**
     * Display the specified resource.
     *
     * @param Community $community
     * @return Application|Factory|View
     */
    public function show(Community $community)
    {
        $query = $community->posts();
        if (request('sort', '') == 'popular') {
            $posts = $query->orderByDesc('votes')->paginate(10);
        } else {
            $posts = $query->latest()->paginate(10);
        }

        return view('communities.show', compact('community', 'posts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Community $community
     * @return Application|Factory|View
     */
    public function edit(Community $community)
    {
        if ($community->user_id !== auth()->id())
            abort(403);

        $topics = Topic::all();
        return view('communities.edit', compact('community', 'topics'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCommunityRequest $request
     * @param Community $community
     * @return RedirectResponse
     */
    public function update(UpdateCommunityRequest $request, Community $community)
    {
        if ($community->user_id !== auth()->id())
            abort(403);

        $community->update($request->validated());
        $community->topics()->sync($request->topics);

        return redirect()->route('communities.index')->with(["message" => "Community Updated Successfully.", "class" => "success"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Community $community
     * @return RedirectResponse
     */
    public function destroy(Community $community)
    {
        if ($community->user_id !== auth()->id())
            abort(403);

        $community->delete();
        $community->topics()->detach();

        return redirect()->route('communities.index')->with(["message" => "Community Deleted Successfully.", "class" => "success"]);
    }
}
