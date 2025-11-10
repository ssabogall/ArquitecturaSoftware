{{--
    View: Home Index
    Purpose: Shows the public home page of the application.

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

    @if(isset($viewData['topPhones']) && $viewData['topPhones']->count() > 0)
        <div class="row g-3 mb-5">
            @foreach ($viewData['topPhones'] as $mobilePhone)
                <div class="col-12 col-md-4">
                    @include('mobilePhones.partials.card', ['mobilePhone' => $mobilePhone, 'showRating' => true, 'showAddToCart' => false])
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info text-center">{{ __('messages.no_results') }}</div>
    @endif

    {{-- Partner Products Section --}}
    <div class="mt-5 pt-4 border-top">
        <div class="text-center mb-4">
            <h2 class="h4 fw-bold">{{ __('messages.our_partners') }}</h2>
            <p class="text-muted">{{ __('messages.partner_insumax') }}</p>
        </div>
        
        <div id="insumaxProducts" class="row g-3 justify-content-center">
            <div class="col-12 text-center">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">{{ __('messages.loading') }}...</span>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" crossorigin="anonymous"></script>
<script type="text/javascript">
$(document).ready(function() {
    $.ajax({
        type: "GET",
        dataType: "json",
        url: 'http://insumax.zone.id/api/products/paginate',
        success: function(response) {
            let html = '';
            
            if (response.data && response.data.length > 0) {
                response.data.forEach(function(product) {
                    html += `
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2">
                            <div class="card h-100 shadow-sm">
                                <img src="${product.image || '/images/placeholder.png'}" 
                                     class="card-img-top" 
                                     alt="${product.name}"
                                     style="height: 150px; object-fit: cover;"
                                     onerror="this.src='/images/placeholder.png'">
                                <div class="card-body d-flex flex-column">
                                    <h6 class="card-title text-truncate" title="${product.name}">${product.name}</h6>
                                    <p class="card-text small text-muted flex-grow-1" style="max-height: 60px; overflow: hidden;">
                                        ${product.description || ''}
                                    </p>
                                    <div class="mt-auto">
                                        <p class="fw-bold text-primary mb-2">$${product.price}</p>
                                        <a href="${response.additionalData.storeProductsLink}"
                                           target="_blank"
                                           class="btn btn-sm btn-outline-primary w-100">
                                            {{ __('messages.view_more') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                });
            } else {
                html = '<div class="col-12"><div class="alert alert-info text-center">{{ __('messages.no_products_available') }}</div></div>';
            }
            
            $('#insumaxProducts').html(html);
        },
        error: function(xhr, status, error) {
            console.error('Error loading INSUMAX products:', error);
            $('#insumaxProducts').html(
                '<div class="col-12"><div class="alert alert-warning text-center">{{ __('messages.error_loading_products') }}</div></div>'
            );
        }
    });
});
</script>
@endpush
