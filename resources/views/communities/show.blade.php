@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <span class>{{ $community->name }}</span>
            <div class="d-flex justify-content-between align-items-center">
                <a href="{{ route('communities.show', $community) }}"
                   class="@if(request('sort', '') != 'popular') text-bg-dark @endif m-1">Newest Post</a>
                <a href="{{ route('communities.show', $community) . "?sort=popular" }}"
                   class="@if(request('sort', '') == 'popular') text-bg-dark @endif m-1">Popular Post</a>
                <a href="{{ route("communities.posts.create", $community) }}"
                   class="btn btn-sm btn-primary">Add Post</a>
            </div>
        </div>

        <div class="card-body">
            @forelse($posts as $post)
                <div class="row">
                    <div
                        class="col-md-1 d-flex flex-column justify-content-center align-content-center mb-2">
                        <a href="{{ route('posts.vote', [$post->id, 1]) }}" class="text-center">
                            <span class="fa fa-2x fa-sort-asc"></span>
                        </a>
                        <b class="text-center">{{ $post->votes }}</b>
                        <a href="{{ route('posts.vote', [$post->id, -1]) }}" class="text-center">
                            <span class="fa fa-2x fa-sort-desc"></span>
                        </a>
                    </div>
                    <div class="col-md-11">
                        <a href="{{ route("communities.posts.show", [$community, $post]) }}" class="link">
                            <h2>{{ $post->title }}</h2>
                        </a>
                        <p>{{ $post->created_at->diffForHumans() }}</p>
                        <p>{{ \Illuminate\Support\Str::words($post->post_text, 10) }}</p>
                    </div>
                    <hr>
                </div>
            @empty
                No Post Found!.
            @endforelse

            {{ $posts->links() }}
        </div>
    </div>
@endsection
