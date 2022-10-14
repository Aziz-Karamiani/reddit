@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Community') }}</div>

                    <div class="card-body">
                        {{ __('Community : ') . $community->name }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
