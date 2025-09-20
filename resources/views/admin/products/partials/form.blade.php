@php
  /** @var \App\Models\MobilePhone $product */
  $isEdit = isset($product) && $product && $product->exists;
@endphp

<div class="mb-3">
  <label for="name" class="form-label">{{ __('messages.name') }}</label>
  <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $isEdit ? $product->getName() : '') }}" required>
  @error('name')
    <div class="text-danger small">{{ $message }}</div>
  @enderror
  </div>

<div class="mb-3">
  <label for="brand" class="form-label">{{ __('messages.brand') }}</label>
  <input type="text" class="form-control" id="brand" name="brand" value="{{ old('brand', $isEdit ? $product->getBrand() : '') }}" required>
  @error('brand')
    <div class="text-danger small">{{ $message }}</div>
  @enderror
</div>

<div class="mb-3">
  <label for="price" class="form-label">{{ __('messages.price') }}</label>
  <input type="number" min="0" step="1" class="form-control" id="price" name="price" value="{{ old('price', $isEdit ? $product->getPrice() : 0) }}" required>
  @error('price')
    <div class="text-danger small">{{ $message }}</div>
  @enderror
</div>

<div class="mb-3">
  <label for="stock" class="form-label">{{ __('messages.stock') }}</label>
  <input type="number" min="0" step="1" class="form-control" id="stock" name="stock" value="{{ old('stock', $isEdit ? $product->getStock() : 0) }}" required>
  @error('stock')
    <div class="text-danger small">{{ $message }}</div>
  @enderror
</div>

<div class="mb-3">
  <label for="photo" class="form-label">{{ __('messages.photo') }}</label>
  <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
  @if($isEdit && !empty($product->getPhotoUrl()))
    <div class="form-text">
      {{ __('messages.current') }}: <a href="{{ $product->getPhotoUrl() }}" target="_blank" rel="noopener noreferrer">{{ basename(parse_url($product->getPhotoUrl(), PHP_URL_PATH)) }}</a>
    </div>
  @endif
  @error('photo')
    <div class="text-danger small">{{ $message }}</div>
  @enderror
</div>
