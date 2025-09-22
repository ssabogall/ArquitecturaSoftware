{{--
  Partial: Phone Card

  @author Alejandro Carmona
--}}

<div class="card h-100">
  @if ($phone->getPhotoUrl())
    <img src="{{ $phone->getPhotoUrl() }}" class="card-img-top img-card" alt="{{ $phone->getName() }}">
  @endif

  <div class="card-body d-flex flex-column">
    <h5 class="card-title mb-1">{{ $phone->getName() }}</h5>
    <div class="text-muted mb-2">{{ __('messages.brand') }}: {{ $phone->getBrand() }}</div>

    @if (!empty($showRating))
      <div class="mb-2">
        @if($phone->getApprovedReviewsAvgRating())
          <span class="badge bg-primary">{{ __('messages.rating') }}: {{ $phone->getApprovedReviewsAvgRatingFormatted() }}/5</span>
          <span class="text-muted small">({{ $phone->getApprovedReviewsCount() }})</span>
        @else
          <span class="text-muted small">{{ __('messages.no_results') }}</span>
        @endif
      </div>
    @endif

    <div class="mt-auto">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <span class="fw-bold">{{ __('messages.currency_symbol') }}{{ $phone->getPriceFormatted() }}</span>
        <a href="{{ route('phones.show', ['id' => $phone->getId()]) }}" class="btn btn-outline-primary btn-sm">{{ __('messages.view') }}</a>
      </div>

      @if (!empty($showAddToCart))
        <form action="{{ route('cart.add') }}" method="POST" class="d-flex gap-2 align-items-center">
          @csrf
          <input type="hidden" name="mobile_phone_id" value="{{ $phone->getId() }}" />
          <input type="number" class="form-control form-control-sm text-center" name="quantity" value="1" min="1" max="{{ $phone->getStock() }}" step="1" required style="width: 120px;" />
          <button type="submit" class="btn btn-primary btn-sm" @if($phone->getStock() <= 0) disabled aria-disabled="true" @endif>{{ __('messages.add_to_cart') }}</button>
        </form>
      @endif
    </div>
  </div>
</div>
