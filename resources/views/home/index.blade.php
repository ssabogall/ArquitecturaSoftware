@extends('layouts.app')

@section('title', __('messages.home'))

@section('header', __('messages.welcome'))

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">{{ __('messages.welcome') }}</div>
            <div class="card-body">
                <div class="text-center">
                    <h1>{{ __('messages.welcome_website') }}</h1>
                    <p class="lead">{{ __('messages.glad_you_are_here') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
