@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
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
                        <a href="{{ route("communities.posts.edit", [$community, $post]) }}"
                           class="btn btn-sm btn-primary">Edit Post</a>
                        <form action="{{ route("communities.posts.destroy", [$community, $post]) }}" method="POST" class="d-inline">
                            @csrf
                            @method("DELETE")
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete Post</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
