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
                    <div class="card h-100">
                        @if ($phone->getPhotoUrl())
                            <img src="{{ $phone->getPhotoUrl() }}" class="card-img-top img-card" alt="{{ $phone->getName() }}">
                        @endif
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title mb-1">{{ $phone->getName() }}</h5>
                            <div class="text-muted mb-2">{{ __('messages.brand') }}: {{ $phone->getBrand() }}</div>
                            <div class="mb-2">
                                @if($phone->getApprovedReviewsAvgRating())
                                    <span class="badge bg-primary">{{ __('messages.rating') }}: {{ $phone->getApprovedReviewsAvgRatingFormatted() }}/5</span>
                                    <span class="text-muted small">({{ $phone->getApprovedReviewsCount() }})</span>
                                @else
                                    <span class="text-muted small">{{ __('messages.no_results') }}</span>
                                @endif
                            </div>
                            <div class="mt-auto d-flex justify-content-between align-items-center">
                                <span class="fw-bold">{{ __('messages.currency_symbol') }}{{ $phone->getPriceFormatted() }}</span>
                                <a href="{{ route('phones.show', ['id' => $phone->getId()]) }}" class="btn btn-outline-primary btn-sm">{{ __('messages.view') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info text-center">{{ __('messages.no_results') }}</div>
    @endif
@endsection
