{{--
    View: Home Index
    Purpose: Muestra la página de inicio pública de la aplicación.

    @author Alejandro Carmona
    @author Miguel Arcila
--}}
@extends('layouts.app')

@section('title', __('messages.home'))

@section('header', '')

@section('content')
<div class="text-center mb-4">
        <h1 class="display-6 fw-bold">{{ __('messages.home_headline') }}</h1>
        <p class="lead text-muted mb-0">{{ __('messages.home_subheadline') }}</p>
    </div>

    @if(isset($topPhones) && $topPhones->count() > 0)
        <div class="row g-3">
            @foreach ($topPhones as $phone)
                <div class="col-12 col-md-4">
                    @include('phones.partials.card', ['phone' => $phone, 'showRating' => true, 'showAddToCart' => false])
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info text-center">{{ __('messages.no_results') }}</div>
    @endif
@endsection
