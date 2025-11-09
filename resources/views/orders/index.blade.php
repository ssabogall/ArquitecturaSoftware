{{--
  View: Index Orders
  Purpose: Muestra la lista de pedidos del usuario.

  @author Miguel Arcila
--}}

@extends('layouts.app')

@section('title', __('messages.my_orders'))

@section('content')
<h1 class="h3 mb-3">{{ __('messages.my_orders') }}</h1>

@if ($viewData['orders']->isEmpty())
  <div class="alert alert-info">{{ __('messages.no_results') }}</div>
@else
  <div class="table-responsive">
    <table class="table align-middle">
      <thead>
        <tr>
          <th>{{ __('messages.id') }}</th>
          <th>{{ __('messages.date') }}</th>
          <th>{{ __('messages.status') }}</th>
          <th class="text-end">{{ __('messages.total') }}</th>
          <th class="text-end">{{ __('messages.actions') }}</th>
        </tr>
      </thead>
      <tbody>
      @foreach ($viewData['orders'] as $order)
        <tr>
          <td>#{{ $order->getId() }}</td>
          <td>{{ $order->getDate() }}</td>
          <td>{{ __('messages.' . $order->getStatus()) }}</td>
          <td class="text-end">{{ __('messages.currency_symbol') }}{{ $order->getTotalFormatted() }}</td>
          <td class="text-end">
            <a class="btn btn-sm btn-outline-primary" href="{{ route('order.show', $order->getId()) }}">{{ __('messages.view') }}</a>
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </div>
  <div class="mt-2">{{ $viewData['orders']->links() }}</div>
@endif
@endsection
