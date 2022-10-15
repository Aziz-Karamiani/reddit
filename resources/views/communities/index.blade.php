@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Create Community') }}</div>

                    <div class="card-body">
                        @if (session('message'))
                            <div class="alert alert-{{ session()->get("class") }}">{{ session()->get("message") }}</div>
                        @endif

                        <a href="{{ route("communities.create") }}" class="btn btn-primary">New Community</a>
                        <hr>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($communities as $community)
                                <tr>
                                    <td><a href="{{ route('communities.show', $community) }}">{{ $community->name }}</a>
                                    </td>
                                    <td>
                                        <a class="btn btn-sm btn-primary" href="{{ route('communities.edit', $community) }}">Edit</a>
                                        <form method="POST" action="{{ route('communities.destroy', $community) }}" class="d-inline">
                                            @csrf
                                            @method("DELETE")
                                            <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Are you sure??')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
