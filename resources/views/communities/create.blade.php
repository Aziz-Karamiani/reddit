@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">{{ __('Create Community') }}</div>

        <div class="card-body">
            <form method="POST" action="{{ route('communities.store') }}">
                @csrf

                <div class="row mb-3">
                    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}*</label>

                    <div class="col-md-6">
                        <input id="name" type="text"
                               class="form-control @error('name') is-invalid @enderror" name="name"
                               value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="description"
                           class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}*</label>

                    <div class="col-md-6">
                                    <textarea name="description"
                                              class="form-control @error('description') is-invalid @enderror"
                                              id="description"
                                              cols="30"
                                              rows="10" required>{{ old('description') }}</textarea>

                        @error('description')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="topics"
                           class="col-md-4 col-form-label text-md-end">{{ __('Topics') }}</label>
                    <div class="col-md-6">
                        <select class="form-control select2" name="topics[]" multiple>
                            @foreach($topics as $topic)
                                <option value="{{ $topic->id }}" name="topics[]">{{ $topic->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


                <div class="row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Create Community') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
