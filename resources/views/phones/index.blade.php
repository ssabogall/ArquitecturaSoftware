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
    <form action="{{ route('phones.index') }}" method="GET" class="d-flex gap-2" role="search" aria-label="{{ __('messages.search') }}">
        <input type="search" name="q" value="{{ $q ?? '' }}" class="form-control form-control-sm" placeholder="{{ __('messages.search_placeholder') }}" aria-label="{{ __('messages.search') }}" />
        <button type="submit" class="btn btn-sm btn-primary">{{ __('messages.search') }}</button>
        @if(($q ?? '') !== '')
            <a href="{{ route('phones.index') }}" class="btn btn-sm btn-outline-secondary">{{ __('messages.clear') }}</a>
        @endif
    </form>
</div>

@if ($phones->count() === 0)
    <div class="alert alert-info">{{ __('messages.no_results') }}</div>
@else
    <div class="row g-3">
        @foreach ($phones as $phone)
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="card h-100">
                    @if ($phone->getPhotoUrl())
                        <img src="{{ $phone->getPhotoUrl() }}" class="card-img-top img-card" alt="{{ $phone->getName() }}">
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title mb-1">{{ $phone->getName() }}</h5>
                        <div class="text-muted mb-2">{{ __('messages.brand') }}: {{ $phone->getBrand() }}</div>
                        <div class="mt-auto">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="fw-bold">{{ __('messages.currency_symbol') }}{{ $phone->getPriceFormatted() }}</span>
                                <a href="{{ route('phones.show', ['id' => $phone->getId()]) }}" class="btn btn-outline-primary btn-sm">{{ __('messages.view') }}</a>
                            </div>
                            <form action="{{ route('cart.add') }}" method="POST" class="d-flex gap-2 align-items-center">
                                @csrf
                                <input type="hidden" name="mobile_phone_id" value="{{ $phone->getId() }}" />
                                <input type="number" class="form-control form-control-sm text-center" name="quantity" value="1" min="1" max="{{ $phone->getStock() }}" step="1" required style="width: 120px;" />
                                <button type="submit" class="btn btn-primary btn-sm" @if($phone->getStock() <= 0) disabled aria-disabled="true" @endif>{{ __('messages.add_to_cart') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-3">
        {{ $phones->links() }}
    </div>
@endif
@endsection
