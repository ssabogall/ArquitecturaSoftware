{{--
  View: Admin Users Create
  Purpose: Shows the form to create a new user in admin.

  @author Alejandro Carmona
--}}
@extends('layouts.admin')

@section('title', __('messages.new_user'))
@section('header', __('messages.new_user'))

@section('content')
<div class="card">
  <div class="card-body">
    <form action="{{ route('admin.users.store') }}" method="POST">
      @csrf
      
      <div class="mb-3">
        <label for="name" class="form-label">{{ __('messages.name') }}</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
        @error('name')
          <div class="text-danger small">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="email" class="form-label">{{ __('messages.email') }}</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
        @error('email')
          <div class="text-danger small">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">{{ __('messages.password') }}</label>
        <input type="password" class="form-control" id="password" name="password" required>
        @error('password')
          <div class="text-danger small">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3 form-check">
        <input type="hidden" name="staff" value="0">
        <input class="form-check-input" type="checkbox" value="1" id="staff" name="staff" {{ old('staff') ? 'checked' : '' }}>
        <label class="form-check-label" for="staff">
          {{ __('messages.staff') }}
        </label>
      </div>

      <div class="mb-3">
        <label for="phone" class="form-label">{{ __('messages.phone') }}</label>
        <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}">
        @error('phone')
          <div class="text-danger small">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="address" class="form-label">{{ __('messages.address') }}</label>
        <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}" placeholder="{{ __('messages.enter_address') }}">
        @error('address')
          <div class="text-danger small">{{ $message }}</div>
        @enderror
        <small class="form-text text-muted">{{ __('messages.start_typing_suggestions') }}</small>
      </div>

      <!-- Google Maps -->
      <div class="mb-3">
        <label class="form-label">{{ __('messages.location_on_map') }}</label>
        <div id="map" style="height: 300px; border-radius: 8px; border: 1px solid #dee2e6;"></div>
        <small class="form-text text-muted">{{ __('messages.marker_updates_on_selection') }}</small>
      </div>

      <div class="mb-3">
        <label for="balance" class="form-label">{{ __('messages.balance') }}</label>
        <input type="number" class="form-control" id="balance" name="balance" value="{{ old('balance', 0) }}" step="0.01" min="0" max="999999.99">
        <div class="form-text">{{ __('messages.currency_symbol') }} (máximo 999,999.99)</div>
        @error('balance')
          <div class="text-danger small">{{ $message }}</div>
        @enderror
      </div>

      <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary">{{ __('messages.save') }}</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">{{ __('messages.cancel') }}</a>
      </div>
    </form>
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