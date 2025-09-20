@extends('layouts.admin')

@section('title', __('messages.orders'))
@section('header', __('messages.orders'))

@section('content')
<div class="card">
    <div class="card-body">
        <p class="mb-0">{{ __('messages.no_results') }}</p>
    </div>
</div>
@endsection
