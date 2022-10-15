@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <span class>{{ __('Community') }}</span>
                        <a href="{{ route("communities.posts.create", $community) }}" class="btn btn-sm btn-primary">Add Post</a>
                    </div>

                    <div class="card-body">
                        {{ __('Community : ') . $community->name }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
