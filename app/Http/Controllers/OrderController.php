<?php

/**
 * OrderController.php
 *
 * Controlador para las órdenes.
 *
 * @author Miguel Arcila
 */

namespace App\Http\Controllers;

use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(Request $request): View
    {
        $orders = Order::with('items.mobilePhone')
            ->where('user_id', $request->user()->getId())
            ->orderByDesc('created_at')
            ->paginate(10);
        $viewData = [
            'orders' => $orders,
        ];

        return view('orders.index', $viewData);
    }

    public function show(Request $request, Order $order): View|RedirectResponse
    {
        if ((int) $order->getUserId() !== (int) $request->user()->getId()) {
            return redirect()->route('order.index')->with('flash.message_key', 'messages.error')->with('flash.level', 'danger');
        }
        $order->load(['items.mobilePhone', 'user']);

        return view('orders.show', ['order' => $order]);
    }

    public function cancel(Request $request, Order $order): RedirectResponse
    {
        if ((int) $order->getUserId() !== (int) $request->user()->getId()) {
            return redirect()->route('order.index')->with('flash.message_key', 'messages.error')->with('flash.level', 'danger');
        }
        if (in_array($order->getStatus(), ['pending', 'paid'], true)) {
            DB::transaction(function () use ($order) {
                $order->loadMissing('items.mobilePhone');
                foreach ($order->items as $it) {
                    $phone = $it->mobilePhone;
                    if ($phone) {
                        $phone->setStock($phone->getStock() + $it->getQuantity());
                        $phone->save();
                    }
                }

                $order->setStatus('cancelled');
                $order->save();
            });

            return back()->with('flash.message_key', 'messages.order_cancelled')->with('flash.level', 'success');
        }

        return back()->with('flash.message_key', 'messages.invalid_action')->with('flash.level', 'warning');
    }

    public function return(Request $request, Order $order): RedirectResponse
    {
        if ((int) $order->getUserId() !== (int) $request->user()->getId()) {
            return redirect()->route('order.index')->with('flash.message_key', 'messages.error')->with('flash.level', 'danger');
        }
        if ($order->getStatus() === 'shipped') {
            DB::transaction(function () use ($order) {
                $order->loadMissing('items.mobilePhone');
                foreach ($order->items as $it) {
                    $phone = $it->mobilePhone;
                    if ($phone) {
                        $phone->setStock($phone->getStock() + $it->getQuantity());
                        $phone->save();
                    }
                }

                $order->setStatus('cancelled');
                $order->save();
            });

            return back()->with('flash.message_key', 'messages.order_cancelled')->with('flash.level', 'success');
        }

        return back()->with('flash.message_key', 'messages.invalid_action')->with('flash.level', 'warning');
    }

    public function invoice(Request $request, Order $order)
    {
        if ((int) $order->getUserId() !== (int) $request->user()->getId()) {
            return redirect()->route('order.index')->with('flash.message_key', 'messages.error')->with('flash.level', 'danger');
        }
        $order->load(['items.mobilePhone', 'user']);
        $pdf = Pdf::loadView('orders.invoice', ['order' => $order]);
        $fileName = 'invoice-'.$order->getId().'.pdf';

        return $pdf->stream($fileName);
    }

    public function invoiceDownload(Request $request, Order $order)
    {
        if ((int) $order->getUserId() !== (int) $request->user()->getId()) {
            return redirect()->route('order.index')->with('flash.message_key', 'messages.error')->with('flash.level', 'danger');
        }
        $order->load(['items.mobilePhone', 'user']);
        $pdf = Pdf::loadView('orders.invoice', ['order' => $order]);
        $fileName = 'invoice-'.$order->getId().'.pdf';

        return $pdf->download($fileName);
    }
}
