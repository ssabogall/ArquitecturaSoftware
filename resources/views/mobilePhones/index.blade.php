{{--
    View: Index Phones
    Purpose: Shows the list of available mobile phones.

    @author Miguel Arcila
--}}

@extends('layouts.app')

@section('title', __('messages.products'))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 m-0">{{ __('messages.products') }}</h1>
    
    <!-- Search Bar -->
    <div class="d-flex gap-2">
        <input type="search" 
               id="searchInput" 
               class="form-control" 
               placeholder="{{ __('messages.search_placeholder') }}" 
               style="width: 300px;">
    </div>
</div>

@if ($viewData['mobilePhones']->count() === 0)
    <div class="alert alert-info">{{ __('messages.no_results') }}</div>
@else
    <div class="row g-3">
        @foreach ($viewData['mobilePhones'] as $mobilePhone)
            <div class="col-12 col-sm-6 col-lg-4">
                @include('mobilePhones.partials.card', ['mobilePhone' => $mobilePhone, 'showAddToCart' => true])
            </div>
        @endforeach
    </div>

    <div class="mt-3">
        {{ $viewData['mobilePhones']->links() }}
    </div>
@endif

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const cards = document.querySelectorAll('.col-12.col-sm-6.col-lg-4');
    
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase().trim();
        
        cards.forEach(card => {
            const cardText = card.textContent.toLowerCase();
            
            if (cardText.includes(searchTerm)) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        });
    });
});
</script>
@endpush

@endsection