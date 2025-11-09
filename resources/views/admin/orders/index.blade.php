{{--
    View: Admin Orders Index
    Purpose: Shows the list of orders in the admin panel.

    @author Alejandro Carmona
--}}
@extends('layouts.admin')

@section('title', __('messages.orders'))
@section('header', __('messages.orders'))

@section('content')
<div class="card">
    <div class="card-body">
        <h5 class="card-title mb-3">{{ __('messages.orders') }}</h5>
        
        @if($viewData['orders']->isEmpty())
            <p class="mb-0">{{ __('messages.no_results') }}</p>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>{{ __('messages.id') }}</th>
                            <th>{{ __('messages.user') }}</th>
                            <th>{{ __('messages.date') }}</th>
                            <th>{{ __('messages.status') }}</th>
                            <th class="text-end">{{ __('messages.total') }}</th>
                            <th>{{ __('messages.items') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($viewData['orders'] as $order)
                            <tr>
                                <td>#{{ $order->getId() }}</td>
                                <td>{{ optional($order->getUser())->getName() ?? __('messages.not_provided') }}</td>
                                <td>{{ $order->getDate() }}</td>
                                <td>
                                    <span class="badge bg-{{ $order->getStatus() === 'paid' ? 'success' : ($order->getStatus() === 'pending' ? 'warning' : ($order->getStatus() === 'shipped' ? 'info' : 'secondary')) }}">
                                        {{ __('messages.' . $order->getStatus()) }}
                                    </span>
                                </td>
                                <td class="text-end">{{ __('messages.currency_symbol') }}{{ $order->getTotalFormatted() }}</td>
                                <td>{{ $order->getItems()->count() }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="mt-3">
                {{ $viewData['orders']->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
