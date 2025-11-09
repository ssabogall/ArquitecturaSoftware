{{--
  View: Index Cart
    Purpose: Shows the contents of the shopping cart.

  @author Miguel Arcila
--}}
@extends('layouts.app')

@section('title', __('messages.cart'))

@section('content')
<h1 class="h3 mb-3">{{ __('messages.cart') }}</h1>

@if (empty($viewData['items'] ?? []))
    <div class="alert alert-info">{{ __('messages.no_results') }}</div>
@else
    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>{{ __('messages.photo') }}</th>
                    <th>{{ __('messages.products') }}</th>
                    <th class="text-center">{{ __('messages.quantity') }}</th>
                    <th class="text-end">{{ __('messages.price') }}</th>
                    <th class="text-end">{{ __('messages.total') }}</th>
                    <th>{{ __('messages.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($viewData['items'] as $it)
                    <tr>
                        <td style="width: 120px;">
                            @if (!empty($it['photo_url']))
                                <img src="{{ $it['photo_url'] }}" alt="{{ $it['name'] }}" class="img-fluid" style="max-height:80px; object-fit:contain;" />
                            @endif
                        </td>
                        <td>
                            <div class="fw-semibold">{{ $it['name'] }}</div>
                            <div class="text-muted small">{{ __('messages.brand') }}: {{ $it['brand'] }}</div>
                        </td>
                        <td class="text-center" style="width: 180px;">
                            <form action="{{ route('cart.update', ['id' => $it['id']]) }}" method="POST" class="d-inline-flex align-items-center gap-2">
                                @csrf
                                @method('PUT')
                                <input type="number" name="quantity" class="form-control form-control-sm text-center" min="0" max="{{ $it['stock'] }}" step="1" value="{{ $it['quantity'] }}" onchange="this.form.submit()" style="width: 120px;" />
                            </form>
                        </td>
                        <td class="text-end">{{ __('messages.currency_symbol') }}{{ $it['price_formatted'] }}</td>
                        <td class="text-end">{{ __('messages.currency_symbol') }}{{ $it['subtotal_formatted'] }}</td>
                        <td>
                            <form action="{{ route('cart.remove', ['id' => $it['id']]) }}" method="POST" onsubmit="return confirm('{{ __('messages.are_you_sure') }}');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">{{ __('messages.delete') }}</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-end mt-3">
        <div class="card" style="min-width: 320px;">
            <div class="card-body">
                @auth
                <div class="d-flex justify-content-between mb-2">
                    <div class="text-muted">{{ __('messages.balance') }}</div>
                    <div class="fw-semibold text-success">{{ __('messages.currency_symbol') }}{{ number_format(auth()->user()->getBalance(), 0, ',', '.') }}</div>
                </div>
                <hr>
                @endauth
                <div class="d-flex justify-content-between">
                    <div class="fw-semibold">{{ __('messages.total') }}</div>
                    <div class="fw-bold">{{ __('messages.currency_symbol') }}{{ $viewData['total_formatted'] }}</div>
                </div>
            </div>
            <div class="card-footer text-end">
                @auth
                <form action="{{ route('cart.checkout') }}" method="POST" class="d-inline">
                    @csrf
                    <button class="btn btn-primary" type="submit">{{ __('messages.checkout') }}</button>
                </form>
                @else
                    <a class="btn btn-primary disabled" aria-disabled="true" href="#">{{ __('messages.checkout') }}</a>
                @endauth
            </div>
        </div>
    </div>
@endif
@endsection
