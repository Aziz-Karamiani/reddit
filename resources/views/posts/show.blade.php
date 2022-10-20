@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">{{ $post->title }}</div>

        <div class="card-body">
            @if(!is_null($post->post_url))
                <div class="mb-2">
                    <a href="{{ $post->post_url }}">{{ $post->post_url }}</a>
                </div>
            @endif
            <p>{{ $post->post_text }}</p>
            <hr>
            @forelse($post->comments as $comment)
                <div class="row rounded mb-1 offset-1">
                    <b>{{ $comment->user->name }}</b>
                    <span>{{ $comment->created_at->diffForHumans() }}</span>
                    <span>{{ $comment->body }}</span>
                    <br>
                    <br>
                </div>
            @empty
            @endforelse
            <hr>
            <div class="container">
                <form action="{{ route('posts.comments.store', $post) }}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <label for="body"
                               class="col-md-4 col-form-label">{{ __('Body') }}</label>
                        <textarea name="body"
                                  class="form-control @error('body') is-invalid @enderror"
                                  id="body"
                                  cols="30"
                                  rows="3" required>{{ old('body') }}</textarea>

                        @error('post_text')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary">Create Comment</button>
                </form>
            </div>

            <hr>
            @if($post->user_id === auth()->id())
                <a href="{{ route("communities.posts.edit", [$community, $post]) }}"
                   class="btn btn-sm btn-primary">Edit Post</a>
            @endif

            @if(in_array(auth()->id(), [$post->user_id, $community->user_id]))
                <form action="{{ route("communities.posts.destroy", [$community, $post]) }}"
                      method="POST"
                      class="d-inline">
                    @csrf
                    @method("DELETE")
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                        Delete
                        Post
                    </button>
                </form>
            @endif
        </div>
    </div>
@endsection
