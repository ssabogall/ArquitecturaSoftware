{{--
    View: Compare Index
    Purpose: Allows users to select 2-3 phones for comparison.

    @author Miguel Arcila
--}}

@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
<div class="mb-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h1 class="h3 mb-2">{{ __('messages.compare_phones') }}</h1>
            <p class="text-muted mb-0">{{ __('messages.select_phones_to_compare') }}</p>
        </div>
        
        <!-- Search Bar -->
        <div class="d-flex gap-2">
            <input type="search" 
                   id="searchInput" 
                   class="form-control" 
                   placeholder="{{ __('messages.search_placeholder') }}" 
                   style="width: 300px;">
        </div>
    </div>
</div>

<form action="{{ route('compare.show') }}" method="POST" id="compareForm">
    @csrf
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if ($viewData['mobilePhones']->count() === 0)
        <div class="alert alert-info">{{ __('messages.no_products') }}</div>
    @else
        <div class="row g-3 mb-4">
            @foreach ($viewData['mobilePhones'] as $mobilePhone)
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="card h-100 phone-select-card" data-phone-id="{{ $viewData['mobilePhones'][$loop->index]->getId() }}">
                        <div class="position-relative">
                            <input type="checkbox" 
                                   class="form-check-input position-absolute top-0 end-0 m-3 phone-checkbox" 
                                   name="phones[]" 
                                   value="{{ $viewData['mobilePhones'][$loop->index]->getId() }}" 
                                   id="phone-{{ $viewData['mobilePhones'][$loop->index]->getId() }}"
                                   style="width: 1.5rem; height: 1.5rem; cursor: pointer; z-index: 10;">
                            
                            @if ($viewData['mobilePhones'][$loop->index]->getPhotoUrl())
                                <img src="{{ $viewData['mobilePhones'][$loop->index]->getPhotoUrl() }}" 
                                     class="card-img-top" 
                                     alt="{{ $viewData['mobilePhones'][$loop->index]->getName() }}"
                                     style="height: 200px; object-fit: contain; padding: 1rem;">
                            @else
                                <div class="card-img-top d-flex align-items-center justify-content-center bg-light" 
                                     style="height: 200px;">
                                    <i class="bi bi-phone fs-1 text-muted"></i>
                                </div>
                            @endif
                        </div>
                        
                        <div class="card-body">
                            <h5 class="card-title">{{ $viewData['mobilePhones'][$loop->index]->getBrand() }}</h5>
                            <p class="card-text text-muted mb-2">{{ $viewData['mobilePhones'][$loop->index]->getName() }}</p>
                            @if ($viewData['mobilePhones'][$loop->index]->specification)
                                <p class="card-text small text-muted">{{ $viewData['mobilePhones'][$loop->index]->specification->getModel() }}</p>
                            @endif
                            <p class="card-text fw-bold text-primary">${{ number_format($viewData['mobilePhones'][$loop->index]->getPrice(), 2) }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-between align-items-center">
            <div>
                <span id="selectedCount" class="badge bg-secondary">0</span>
                <span class="text-muted ms-2">{{ __('messages.phones_selected') }}</span>
            </div>
            <button type="submit" 
                    class="btn btn-primary" 
                    id="compareButton" 
                    disabled>
                <i class="bi bi-arrow-left-right"></i>
                {{ __('messages.compare_button') }}
            </button>
        </div>
    @endif
</form>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('.phone-checkbox');
    const compareButton = document.getElementById('compareButton');
    const selectedCount = document.getElementById('selectedCount');
    const cards = document.querySelectorAll('.phone-select-card');
    const searchInput = document.getElementById('searchInput');
    const MAX_SELECTION = 3;
    const MIN_SELECTION = 2;
    
    // Search functionality
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase().trim();
        
        cards.forEach(card => {
            const brand = card.querySelector('.card-title').textContent.toLowerCase();
            const model = card.querySelector('.card-text.text-muted').textContent.toLowerCase();
            
            if (brand.includes(searchTerm) || model.includes(searchTerm)) {
                card.closest('.col-12').style.display = '';
            } else {
                card.closest('.col-12').style.display = 'none';
            }
        });
    });
    
    function updateSelection() {
        const checked = document.querySelectorAll('.phone-checkbox:checked');
        const count = checked.length;
        
        selectedCount.textContent = count;
        selectedCount.className = count >= MIN_SELECTION ? 'badge bg-success' : 'badge bg-secondary';
        
        compareButton.disabled = count < MIN_SELECTION || count > MAX_SELECTION;
        
        checkboxes.forEach(checkbox => {
            if (!checkbox.checked && count >= MAX_SELECTION) {
                checkbox.disabled = true;
            } else {
                checkbox.disabled = false;
            }
        });
        
        cards.forEach(card => {
            const checkbox = card.querySelector('.phone-checkbox');
            if (checkbox.checked) {
                card.classList.add('border-primary', 'border-3');
            } else {
                card.classList.remove('border-primary', 'border-3');
            }
        });
    }
    
    cards.forEach(card => {
        card.addEventListener('click', function(e) {
            if (e.target.classList.contains('phone-checkbox')) {
                return;
            }
            
            const checkbox = card.querySelector('.phone-checkbox');
            if (!checkbox.disabled) {
                checkbox.checked = !checkbox.checked;
                updateSelection();
            }
        });
        
        card.style.cursor = 'pointer';
    });
    
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateSelection);
    });

    updateSelection();
});
</script>
@endpush

@endsection