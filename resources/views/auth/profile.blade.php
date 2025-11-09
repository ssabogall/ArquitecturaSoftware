{{--
    View: User Profile
    Purpose: Allows viewing and updating name, phone, and address.

    @author Miguel Arcila
--}}
@extends('layouts.app')

@section('title', __('messages.my_account'))
@section('header', __('messages.my_account'))

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">{{ __('messages.my_account') }}</div>
            <div class="card-body">
                @if (session('flash.message'))
                    <div class="alert alert-{{ session('flash.level', 'success') }}" role="alert">
                        {{ session('flash.message') }}
                    </div>
                @elseif (session('flash.message_key'))
                    <div class="alert alert-{{ session('flash.level', 'success') }}" role="alert">
                        {{ __(session('flash.message_key')) }}
                    </div>
                @endif

                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">{{ __('messages.name') }}</label>
                        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $viewData['user']->getName()) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">{{ __('messages.balance') }}</label>
                        <div class="form-control-plaintext fw-bold text-success">
                            {{ __('messages.currency_symbol') }}{{ number_format($viewData['user']->getBalance(), 0, ',', '.') }}
                        </div>
                        <small class="text-muted">{{ __('messages.balance') }} {{ __('messages.available_for_purchases') }}</small>
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">{{ __('messages.phone') }} ({{ __('messages.optional') }})</label>
                        <input type="text" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $viewData['user']->getPhone()) }}">
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">{{ __('messages.address') }} ({{ __('messages.optional') }})</label>
                        <input type="text" id="address" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address', $viewData['user']->getAddress()) }}" placeholder="{{ __('messages.enter_address') }}">
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">{{ __('messages.start_typing_suggestions') }}</small>
                    </div>

                    <!-- Google Maps -->
                    <div class="mb-3">
                        <label class="form-label">{{ __('messages.location_on_map') }}</label>
                        <div id="map" style="height: 300px; border-radius: 8px; border: 1px solid #dee2e6;"></div>
                        <small class="form-text text-muted">{{ __('messages.marker_updates_on_selection') }}</small>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">{{ __('messages.save') }}</button>
                        <a href="{{ route('home.index') }}" class="btn btn-secondary">{{ __('messages.cancel') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
let map;
let marker;
let autocomplete;

function initMap() {
    
    const defaultLocation = { lat: 4.6097, lng: -74.0817 };
    
    map = new google.maps.Map(document.getElementById('map'), {
        center: defaultLocation,
        zoom: 13,
        mapTypeControl: false,
        streetViewControl: false
    });

    marker = new google.maps.Marker({
        map: map,
        position: defaultLocation,
        draggable: true
    });
    
    const addressInput = document.getElementById('address');
    autocomplete = new google.maps.places.Autocomplete(addressInput, {
        componentRestrictions: { country: 'co' },
        fields: ['formatted_address', 'geometry', 'name']
    });
    
    autocomplete.addListener('place_changed', function() {
        const place = autocomplete.getPlace();
        
        if (!place.geometry) {
            return;
        }
        
        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);
        }
        
        marker.setPosition(place.geometry.location);
        marker.setVisible(true);
        
        addressInput.value = place.formatted_address || place.name;
    });
    
    marker.addListener('dragend', function(event) {
        const geocoder = new google.maps.Geocoder();
        geocoder.geocode({ location: event.latLng }, function(results, status) {
            if (status === 'OK' && results[0]) {
                addressInput.value = results[0].formatted_address;
            }
        });
    });
}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.key') }}&libraries=places&callback=initMap" async defer></script>
@endpush