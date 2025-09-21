{{--
  View: Show Phone
  Purpose: Muestra los detalles de un teléfono específico.

  @author Miguel Arcila
--}}

@extends('layouts.app')

@section('title', $phone->getName())

@section('content')
<div class="mb-3">
    <div>
        <a href="{{ route('phones.index') }}" class="btn btn-outline-primary btn-sm">&larr; {{ __('messages.back') }}</a>
    </div>
    <h1 class="h3 mt-2 mb-1">{{ $phone->getName() }}</h1>
    <div class="text-muted">{{ __('messages.brand') }}: {{ $phone->getBrand() }}</div>
    <div class="fw-bold fs-5">{{ __('messages.currency_symbol') }}{{ $phone->getPriceFormatted() }}</div>
    @if ($phone->getStock() > 0 && $phone->getStock() <= 5)
        <div class="alert alert-warning py-1 px-2 d-inline-block mt-2 mb-0">
            {{ __('messages.last_units', ['count' => $phone->getStock()]) }}
        </div>
    @endif
    <form action="{{ route('cart.add') }}" method="POST" class="d-flex align-items-center gap-2 mt-2">
        @csrf
        <input type="hidden" name="mobile_phone_id" value="{{ $phone->getId() }}" />
        <input type="number" class="form-control form-control-sm text-center" name="quantity" value="1" min="1" max="{{ $phone->getStock() }}" step="1" required style="width: 140px;" />
        <button type="submit" class="btn btn-primary btn-sm" @if($phone->getStock() <= 0) disabled aria-disabled="true" @endif>{{ __('messages.add_to_cart') }}</button>
    </form>
</div>

@if (($reviewsCount ?? 0) > 0)
    <div class="mb-3 d-flex align-items-center gap-2">
        <div>
            @for ($i = 0; $i < floor($reviewsAvg ?? 0); $i++)
                <i class="bi bi-star-fill text-warning"></i>
            @endfor
            @if (isset($reviewsAvg) && ($reviewsAvg - floor($reviewsAvg)) >= 0.5)
                <i class="bi bi-star-half text-warning"></i>
            @endif
            @for ($i = 0; $i < 5 - floor($reviewsAvg ?? 0) - ((isset($reviewsAvg) && ($reviewsAvg - floor($reviewsAvg)) >= 0.5) ? 1 : 0); $i++)
                <i class="bi bi-star text-warning"></i>
            @endfor
        </div>
        <div class="text-muted">
            <strong>{{ __('messages.average_rating') }}:</strong>
            {{ $reviewsAvg }} {{ __('messages.out_of_max', ['max' => 5]) }}
            <span class="ms-2">({{ __('messages.based_on_reviews', ['count' => $reviewsCount]) }})</span>
        </div>
    </div>
@endif

<div class="row g-4">
    <div class="col-12 col-lg-6">
        @if ($phone->getPhotoUrl())
            <img src="{{ $phone->getPhotoUrl() }}" class="img-product img-fluid rounded shadow-sm" alt="{{ $phone->getName() }}" />
        @endif
    </div>
    <div class="col-12 col-lg-6">
        <div class="card">
            <div class="card-header">{{ __('messages.specifications') }}</div>
            <div class="card-body">
                @if ($phone->specification)
                    <dl class="row mb-0">
                        <dt class="col-sm-5">{{ __('messages.model') }}</dt>
                        <dd class="col-sm-7">{{ $phone->specification->getModel() }}</dd>

                        <dt class="col-sm-5">{{ __('messages.processor') }}</dt>
                        <dd class="col-sm-7">{{ $phone->specification->getProcessor() }}</dd>

                        <dt class="col-sm-5">{{ __('messages.battery') }}</dt>
                        <dd class="col-sm-7">{{ $phone->specification->getBattery() }}</dd>

                        <dt class="col-sm-5">{{ __('messages.screen_size') }}</dt>
                        <dd class="col-sm-7">{{ $phone->specification->getScreenSize() }}</dd>

                        <dt class="col-sm-5">{{ __('messages.screen_tech') }}</dt>
                        <dd class="col-sm-7">{{ $phone->specification->getScreenTech() }}</dd>

                        <dt class="col-sm-5">{{ __('messages.ram') }}</dt>
                        <dd class="col-sm-7">{{ $phone->specification->getRam() }}</dd>

                        <dt class="col-sm-5">{{ __('messages.storage') }}</dt>
                        <dd class="col-sm-7">{{ $phone->specification->getStorage() }}</dd>

                        <dt class="col-sm-5">{{ __('messages.camera_specs') }}</dt>
                        <dd class="col-sm-7">{{ $phone->specification->getCameraSpecs() }}</dd>

                        <dt class="col-sm-5">{{ __('messages.color') }}</dt>
                        <dd class="col-sm-7">{{ $phone->specification->getColor() }}</dd>
                    </dl>
                @else
                    <p class="text-muted mb-0">{{ __('messages.no_results') }}</p>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="mt-4">
    @auth
        <div class="d-flex justify-content-end mb-2">
            <button class="btn btn-outline-primary" type="button" data-bs-toggle="collapse" data-bs-target="#reviewForm" aria-expanded="false" aria-controls="reviewForm">
                <i class="bi bi-pencil-square me-1"></i>{{ __('messages.leave_review') }}
            </button>
        </div>
        <div class="collapse" id="reviewForm">
            <div class="card mb-3">
                <div class="card-header">{{ __('messages.leave_review') }}</div>
                <div class="card-body">
                <form action="{{ route('phones.reviews.submit', ['id' => $phone->getId()]) }}" method="POST" class="row g-3">
                    @csrf
                    <div class="col-12 col-md-4">
                        <label for="rating" class="form-label">{{ __('messages.rating') }}</label>
                        <select name="rating" id="rating" class="form-select" required>
                            <option value="">{{ __('messages.select') }}</option>
                            @for ($i = 5; $i >= 1; $i--)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-12 col-md-8">
                        <label for="comments" class="form-label">{{ __('messages.comments') }} <span class="text-muted">({{ __('messages.optional') }})</span></label>
                        <textarea name="comments" id="comments" class="form-control" rows="2" maxlength="1000"></textarea>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">{{ __('messages.submit') }}</button>
                        <span class="text-muted ms-2 small">{{ __('messages.review_submit_info') }}</span>
                    </div>
                </form>
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-info mb-3">
            <a href="{{ route('login') }}">{{ __('messages.login') }}</a>
            <span class="mx-1">{{ __('messages.or') }}</span>
            <a href="{{ route('register') }}">{{ __('messages.register') }}</a>
            {{ __('messages.to_review_info') }}
        </div>
    @endauth
    <div class="card">
        <div class="card-header">{{ __('messages.reviews') }}</div>
        <div class="card-body">
            @if ($phone->reviews->isEmpty())
                <p class="text-muted mb-0">{{ __('messages.no_results') }}</p>
            @else
                <ul class="list-group list-group-flush">
                    @foreach ($phone->reviews as $review)
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between">
                                <strong>{{ $review->user ? $review->user->getName() : __('messages.not_provided') }}</strong>
                                <span class="badge bg-primary">{{ __('messages.rating') }}: {{ $review->getRating() }}/5</span>
                            </div>
                            <p class="mb-0">{{ $review->getComments() }}</p>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
    
</div>
@endsection
