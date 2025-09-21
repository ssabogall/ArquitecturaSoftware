{{--
  View: Admin Products Form Partial
  Purpose: Parcial de formulario para crear/editar productos en admin.

  @author Alejandro Carmona
--}}
{{-- Eliminado uso de PHP crudo. Usaremos comprobaciones inline con isset --}}

<div class="mb-3">
  <label for="name" class="form-label">{{ __('messages.name') }}</label>
    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', (isset($product) && $product && $product->exists) ? $product->getName() : '') }}" required>
  @error('name')
    <div class="text-danger small">{{ $message }}</div>
  @enderror
  </div>

<div class="mb-3">
  <label for="brand" class="form-label">{{ __('messages.brand') }}</label>
    <input type="text" class="form-control" id="brand" name="brand" value="{{ old('brand', (isset($product) && $product && $product->exists) ? $product->getBrand() : '') }}" required>
  @error('brand')
    <div class="text-danger small">{{ $message }}</div>
  @enderror
</div>

<div class="mb-3">
  <label for="price" class="form-label">{{ __('messages.price') }}</label>
    <input type="number" min="0" step="1" class="form-control" id="price" name="price" value="{{ old('price', (isset($product) && $product && $product->exists) ? $product->getPrice() : 0) }}" required>
  @error('price')
    <div class="text-danger small">{{ $message }}</div>
  @enderror
</div>

<div class="mb-3">
  <label for="stock" class="form-label">{{ __('messages.stock') }}</label>
    <input type="number" min="0" step="1" class="form-control" id="stock" name="stock" value="{{ old('stock', (isset($product) && $product && $product->exists) ? $product->getStock() : 0) }}" required>
  @error('stock')
    <div class="text-danger small">{{ $message }}</div>
  @enderror
</div>

<div class="mb-3">
  <label for="photo" class="form-label">{{ __('messages.photo') }}</label>
  <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
    @if(isset($product) && $product && $product->exists && !empty($product->getPhotoUrl()))
    <div class="form-text">
  {{ __('messages.current') }}: <a href="{{ $product->getPhotoUrl() }}" target="_blank" rel="noopener noreferrer">{{ $product->getPhotoFilename() }}</a>
    </div>
  @endif
  @error('photo')
    <div class="text-danger small">{{ $message }}</div>
  @enderror
</div>
