@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $post->title }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('communities.posts.update', [$community, $post]) }}" enctype="multipart/form-data">
                            @csrf
                            @method("PUT")

                            <div class="row mb-3">
                                <label for="title" class="col-md-4 col-form-label text-md-end">{{ __('Title') }}*</label>

                                <div class="col-md-6">
                                    <input id="title" type="text"
                                           class="form-control @error('title') is-invalid @enderror" name="title"
                                           value="{{ $post->title }}" required autocomplete="title" autofocus>

                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="post_text"
                                       class="col-md-4 col-form-label text-md-end">{{ __('Post Text') }}</label>

                                <div class="col-md-6">
                                    <textarea name="post_text"
                                              class="form-control @error('post_text') is-invalid @enderror"
                                              id="post_text"
                                              cols="30"
                                              rows="10" required>{{ $post->post_text }}</textarea>

                                    @error('post_text')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="post_url"
                                       class="col-md-4 col-form-label text-md-end">{{ __('Post Url') }}</label>

                                <div class="col-md-6">
                                    <textarea name="post_url"
                                              class="form-control @error('post_url') is-invalid @enderror"
                                              id="post_url"
                                              cols="30"
                                              rows="2" required>{{ $post->post_url }}</textarea>

                                    @error('post_url')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="post_image"
                                       class="col-md-4 col-form-label text-md-end">{{ __('Image') }}</label>

                                <div class="col-md-6">
                                    <input type="file" name="post_image">
                                    @error('post_image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update Post') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
