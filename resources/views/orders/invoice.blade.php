{{--
  View: Invoice PDF
  Purpose: Plantilla de factura para PDF. Usa getters y traducciones.

  @author Miguel Arcila
--}}
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #222; }
        .header { text-align: center; margin-bottom: 12px; }
        .title { font-size: 20px; font-weight: bold; margin: 0; }
        .meta { margin-top: 4px; font-size: 12px; color: #555; }
        .section { margin: 12px 0; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 6px; text-align: left; }
        th { background: #f5f5f5; }
        .text-end { text-align: right; }
        .small { font-size: 11px; color: #777; }
    </style>
</head>
<body>
    <div class="header">
        <p class="title">{{ __('messages.invoice') }}</p>
        <div class="meta">{{ __('messages.invoice_number') }}: #{{ $order->getId() }}</div>
        <div class="meta">{{ __('messages.date') }}: {{ $order->getDate() }}</div>
    </div>

    <div class="section">
        <strong>{{ __('messages.my_profile') }}</strong>
        <div>{{ $order->user?->getName() }}</div>
        <div>{{ __('messages.email') }}: {{ $order->user?->getEmail() }}</div>
        <div>{{ __('messages.address') }}: {{ $order->user?->getAddress() ?? __('messages.not_provided') }}</div>
        <div>{{ __('messages.phone') }}: {{ $order->user?->getPhone() ?? __('messages.not_provided') }}</div>
    </div>

    <div class="section">
        <table>
            <thead>
                <tr>
                    <th style="width:50%">{{ __('messages.products') }}</th>
                    <th style="width:15%" class="text-end">{{ __('messages.quantity') }}</th>
                    <th style="width:15%" class="text-end">{{ __('messages.price') }}</th>
                    <th style="width:20%" class="text-end">{{ __('messages.total') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($order->items as $it)
                    <tr>
                        <td>
                            {{ $it->mobilePhone?->getName() ?? __('messages.not_provided') }}
                            <div class="small">{{ __('messages.brand') }}: {{ $it->mobilePhone?->getBrand() ?? __('messages.not_provided') }}</div>
                        </td>
                        <td class="text-end">{{ $it->getQuantity() }}</td>
                        <td class="text-end">{{ __('messages.currency_symbol') }}{{ $it->getPriceFormatted() }}</td>
                        <td class="text-end">{{ __('messages.currency_symbol') }}{{ $it->getSubtotalFormatted() }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">{{ __('messages.no_results') }}</td>
                    </tr>
                @endforelse
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3" class="text-end">{{ __('messages.total') }}</th>
                    <th class="text-end">{{ __('messages.currency_symbol') }}{{ $order->getTotalFormatted() }}</th>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="section small">
        {{ __('messages.status') }}: {{ __('messages.' . $order->getStatus()) }}
    </div>
</body>
</html>
