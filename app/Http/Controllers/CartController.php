<?php

/**
 * CartController.php
 *
 * Controller for the shopping cart.
 *
 * @author Miguel Arcila
 */

namespace App\Http\Controllers;

use App\Models\MobilePhone;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Throwable;

class CartController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $sessionItems = session('cart.items', []);

        $total = 0;
        $displayItems = [];
        foreach ($sessionItems as $itemData) {
            $price = (int) ($itemData['price'] ?? 0);
            $quantity = (int) ($itemData['quantity'] ?? 0);
            $subtotal = $price * $quantity;
            $total += $subtotal;

            $displayItems[] = array_merge($itemData, [
                'price_formatted' => number_format($price, 0, ',', '.'),
                'subtotal_formatted' => number_format($subtotal, 0, ',', '.'),
            ]);
        }

        $viewData['items'] = $displayItems;
        $viewData['total'] = $total;
        $viewData['total_formatted'] = number_format($total, 0, ',', '.');

        return view('cart.index')->with('viewData', $viewData);
    }

    public function add(Request $request): RedirectResponse
    {
        MobilePhone::validateAddToCart($request);

        $mobilePhone = MobilePhone::findOrFail((int) $request->input('mobile_phone_id'));
        $quantity = (int) $request->input('quantity');
        $stock = $mobilePhone->getStock();
        if ($quantity > $stock) {
            $quantity = $stock;
        }

        $items = session('cart.items', []);
        $mobilePhoneId = $mobilePhone->getId();

        if (isset($items[$mobilePhoneId])) {
            $newQuantity = $items[$mobilePhoneId]['quantity'] + $quantity;
            $items[$mobilePhoneId]['quantity'] = min($newQuantity, $stock);
        } else {
            $items[$mobilePhoneId] = [
                'id' => $mobilePhoneId,
                'name' => $mobilePhone->getName(),
                'brand' => $mobilePhone->getBrand(),
                'photo_url' => $mobilePhone->getPhotoUrl(),
                'price' => $mobilePhone->getPrice(),
                'quantity' => $quantity,
                'stock' => $stock,
            ];
        }

        session(['cart.items' => $items]);
        session()->flash('flash.message_key', 'messages.added_to_cart');
        session()->flash('flash.level', 'success');

        return redirect()->back();
    }

    public function update(Request $request, int $mobilePhoneId): RedirectResponse
    {
        MobilePhone::validateUpdateCartItem($request);

        $items = session('cart.items', []);
        if (! isset($items[$mobilePhoneId])) {
            return redirect()->route('cart.index');
        }

        $mobilePhone = MobilePhone::find($mobilePhoneId);
        $stock = $mobilePhone ? $mobilePhone->getStock() : ($items[$mobilePhoneId]['stock'] ?? 0);

        $quantity = (int) $request->input('quantity');
        if ($quantity <= 0) {
            unset($items[$mobilePhoneId]);
        } else {
            $items[$mobilePhoneId]['quantity'] = min($quantity, $stock);
        }

        session(['cart.items' => $items]);
        session()->flash('flash.message_key', 'messages.cart_updated');
        session()->flash('flash.level', 'success');

        return redirect()->route('cart.index');
    }

    public function remove(int $mobilePhoneId): RedirectResponse
    {
        $items = session('cart.items', []);
        if (isset($items[$mobilePhoneId])) {
            unset($items[$mobilePhoneId]);
            session(['cart.items' => $items]);
            session()->flash('flash.message_key', 'messages.item_removed');
            session()->flash('flash.level', 'warning');
        }

        return redirect()->route('cart.index');
    }

    public function checkout(Request $request): RedirectResponse
    {
        $user = $request->user();

        if (empty($user->getAddress())) {
            return redirect()->route('cart.index')
                ->with('flash.message_key', 'messages.address_required_for_checkout')
                ->with('flash.level', 'info');
        }

        $items = session('cart.items', []);
        if (empty($items)) {
            return redirect()->route('cart.index')
                ->with('flash.message_key', 'messages.no_results')
                ->with('flash.level', 'warning');
        }

        $total = 0;
        $orderItemsData = [];
        foreach ($items as $cartItem) {
            $mobilePhone = MobilePhone::find($cartItem['id']);
            if (! $mobilePhone) {
                return redirect()->route('cart.index')
                    ->with('flash.message_key', 'messages.error')
                    ->with('flash.level', 'danger');
            }
            $quantity = min($cartItem['quantity'], $mobilePhone->getStock());
            if ($quantity <= 0) {
                return redirect()->route('cart.index')
                    ->with('flash.message_key', 'messages.error')
                    ->with('flash.level', 'danger');
            }
            $price = $mobilePhone->getPrice();
            $total += ($price * $quantity);
            $orderItemsData[] = [
                'mobilePhone' => $mobilePhone,
                'quantity' => $quantity,
                'price' => $price,
            ];
        }

        if (! $user->hasBalance($total)) {
            $balanceFormatted = '$'.number_format($user->getBalance(), 0, ',', '.');
            $totalFormatted = '$'.number_format($total, 0, ',', '.');

            return redirect()->route('cart.index')
                ->with('flash.message', "Saldo insuficiente. Tu saldo actual es {$balanceFormatted} y el total de la orden es {$totalFormatted}.")
                ->with('flash.level', 'danger');
        }

        DB::beginTransaction();
        try {
            $user->deductBalance($total);
            $user->save();

            $order = new Order;
            $order->setDate(now()->toDateString());
            $order->setStatus('pending');
            $order->setTotal($total);
            $order->setUserId($user->getId());
            $order->save();

            foreach ($orderItemsData as $row) {
                $mobilePhone = $row['mobilePhone'];
                $quantity = $row['quantity'];
                $price = $row['price'];

                $mobilePhone->setStock($mobilePhone->getStock() - $quantity);
                $mobilePhone->save();

                $orderItem = new OrderItem;
                $orderItem->setOrderId($order->getId());
                $orderItem->setMobilePhoneId($mobilePhone->getId());
                $orderItem->setQuantity($quantity);
                $orderItem->setPrice($price);
                $orderItem->save();
            }

            DB::commit();
        } catch (Throwable $exception) {
            DB::rollBack();

            return redirect()->route('cart.index')
                ->with('flash.message_key', 'messages.error')
                ->with('flash.level', 'danger');
        }

        session()->forget('cart.items');

        return redirect()->route('order.show', ['order' => $order->getId()])
            ->with('flash.message_key', 'messages.order_created')
            ->with('flash.level', 'success');
    }
}
