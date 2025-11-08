{{--
  View: Show Order
  Purpose: Muestra los detalles de un pedido específico.

  @author Miguel Arcila
--}}

@extends('layouts.app')

@section('title', __('messages.orders'))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h1 class="h4 m-0">{{ __('messages.orders') }} #{{ $order->getId() }}</h1>
  <a href="{{ route('order.index') }}" class="btn btn-outline-secondary btn-sm">&larr; {{ __('messages.back') }}</a>
</div>

<div class="card mb-3">
  <div class="card-body d-flex justify-content-between align-items-center">
    <div>
  <div class="mb-1"><strong>{{ __('messages.status') }}:</strong> {{ __('messages.' . $order->getStatus()) }}</div>
  <div class="mb-1"><strong>{{ __('messages.date') }}:</strong> {{ $order->getDate() }}</div>
  <div class="mb-1"><strong>{{ __('messages.total') }}:</strong> {{ __('messages.currency_symbol') }}{{ $order->getTotalFormatted() }}</div>
  <div class="mb-1"><strong>{{ __('messages.address') }}:</strong> {{ optional($order->user)->getAddress() ?? __('messages.not_provided') }}</div>
  <div class="mb-1"><strong>{{ __('messages.phone') }}:</strong> {{ optional($order->user)->getPhone() ?? __('messages.not_provided') }}</div>

  <div class="mt-2 d-flex gap-2">
    <a href="{{ route('order.invoice', $order->getId()) }}" class="btn btn-outline-secondary btn-sm">{{ __('messages.view_pdf') }}</a>
    <a href="{{ route('order.invoice.download', $order->getId()) }}" class="btn btn-secondary btn-sm">{{ __('messages.download_pdf') }}</a>
  </div>
    </div>
    <div class="d-flex gap-2">
      @if (in_array($order->getStatus(), ['pending','paid']))
        <form action="{{ route('order.cancel', $order->getId()) }}" method="POST">
          @csrf
          @method('PATCH')
          <button class="btn btn-outline-danger btn-sm" type="submit">{{ __('messages.cancel') }}</button>
        </form>
      @endif
      @if ($order->getStatus() === 'shipped')
        <form action="{{ route('order.return', $order->getId()) }}" method="POST">
          @csrf
          @method('PATCH')
          <button class="btn btn-outline-warning btn-sm" type="submit">{{ __('messages.return') }}</button>
        </form>
      @endif
    </div>
  </div>
</div>

<div class="card">
  <div class="card-header">{{ __('messages.products') }}</div>
  <div class="card-body p-0">
    @if ($order->items->isEmpty())
      <p class="p-3 m-0 text-muted">{{ __('messages.no_results') }}</p>
    @else
      <ul class="list-group list-group-flush">
        @foreach ($order->items as $it)
          <li class="list-group-item">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <div class="fw-semibold">{{ optional($it->mobilePhone)->getName() }}</div>
                <div class="text-muted small">{{ __('messages.quantity') }}: {{ $it->getQuantity() }}</div>
                <div class="text-muted small">{{ __('messages.price') }}: {{ __('messages.currency_symbol') }}{{ $it->getPriceFormatted() }}</div>
              </div>
              <div>
                @auth
                  <a href="{{ route('mobilePhones.show', ['id' => $it->getMobilePhoneId()]) }}" class="btn btn-sm btn-outline-primary">{{ __('messages.leave_review') }}</a>
                @endauth
              </div>
            </div>
          </li>
        @endforeach
      </ul>
    @endif
  </div>
</div>
@endsection
