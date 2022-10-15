@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <span class>{{ $community->name }}</span>
                        <a href="{{ route("communities.posts.create", $community) }}" class="btn btn-sm btn-primary">Add Post</a>
                    </div>

                    <div class="card-body">
                        @forelse($posts as $post)
                            <a href="{{ route("communities.posts.show", [$community, $post]) }}" class="link">
                                <h2>{{ $post->title }}</h2>
                            </a>
                            <p>{{ \Illuminate\Support\Str::words($post->post_text, 10) }}</p>
                            <hr>
                        @empty
                            No Post Found!.
                        @endforelse

                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
