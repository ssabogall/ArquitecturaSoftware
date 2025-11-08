{{--
  View: Index Phones
  Purpose: Muestra la lista de teléfonos móviles disponibles.

  @author Miguel Arcila
--}}

@extends('layouts.app')

@section('title', __('messages.products'))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 m-0">{{ __('messages.products') }}</h1>
    <form action="{{ route('mobilePhones.index') }}" method="GET" class="d-flex gap-2" role="search" aria-label="{{ __('messages.search') }}">
        <input type="search" name="q" value="{{ $q ?? '' }}" class="form-control form-control-sm" placeholder="{{ __('messages.search_placeholder') }}" aria-label="{{ __('messages.search') }}" />
        <button type="submit" class="btn btn-sm btn-primary">{{ __('messages.search') }}</button>
        @if(($q ?? '') !== '')
            <a href="{{ route('mobilePhones.index') }}" class="btn btn-sm btn-outline-secondary">{{ __('messages.clear') }}</a>
        @endif
    </form>
</div>

@if ($mobilePhones->count() === 0)
    <div class="alert alert-info">{{ __('messages.no_results') }}</div>
@else
    <div class="row g-3">
        @foreach ($mobilePhones as $mobilePhone)
            <div class="col-12 col-sm-6 col-lg-4">
                @include('mobilePhones.partials.card', ['mobilePhone' => $mobilePhone, 'showAddToCart' => true])
            </div>
        @endforeach
    </div>

    <div class="mt-3">
        {{ $mobilePhones->links() }}
    </div>
@endif
@endsection
