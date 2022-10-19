@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">{{ __('Popular Posts') }}</div>

        <div class="card-body">
            @foreach($posts as $post)
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
                        <a href="{{ route("communities.posts.show", [$post->community, $post]) }}" class="link">
                            <h2>{{ $post->title }}</h2>
                        </a>
                        <p>{{ $post->created_at->diffForHumans() }}</p>
                        <p>{{ \Illuminate\Support\Str::words($post->post_text, 10) }}</p>
                    </div>
                    <hr>
                </div>
            @endforeach
        </div>
    </div>
@endsection
