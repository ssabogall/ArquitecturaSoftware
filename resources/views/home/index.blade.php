@extends('layout.app')

@section('title', __('Home'))

@section('header', __('Welcome'))

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">{{ __('Welcome') }}</div>
            <div class="card-body">
                <div class="text-center">
                    <h1>{{ __('Welcome to our website') }}</h1>
                    <p class="lead">{{ __('We are glad you are here') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
