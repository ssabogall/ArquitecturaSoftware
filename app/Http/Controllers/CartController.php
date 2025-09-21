<?php

/**
 * CartController.php
 *
 * Controlador para el carrito de compras.
 *
 * @author Miguel Arcila
 *
 */

namespace App\Http\Controllers;

use App\Models\MobilePhone;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{

    public function index(): View
    {
        $viewData = [];
        $sessionItems = session('cart.items', []);

        $total = 0;
        $displayItems = [];
        foreach ($sessionItems as $it) {
            $price = (int) ($it['price'] ?? 0);
            $qty = (int) ($it['quantity'] ?? 0);
            $subtotal = $price * $qty;
            $total += $subtotal;

            $displayItems[] = array_merge($it, [
                'price_formatted' => number_format($price, 0, ',', '.'),
                'subtotal_formatted' => number_format($subtotal, 0, ',', '.'),
            ]);
        }

        $viewData['items'] = $displayItems;
        $viewData['total'] = $total;
        $viewData['total_formatted'] = number_format($total, 0, ',', '.');

        return view('cart.index', $viewData);
    }

    public function add(Request $request): RedirectResponse
    {
        $request->validate([
            'mobile_phone_id' => 'required|integer|exists:mobile_phones,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $phone = MobilePhone::findOrFail((int) $request->input('mobile_phone_id'));
        $qty = (int) $request->input('quantity');
        $stock = $phone->getStock();
        if ($qty > $stock) {
            $qty = $stock;
        }

        $items = session('cart.items', []);
        $id = $phone->getId();

        if (isset($items[$id])) {
            $newQty = $items[$id]['quantity'] + $qty;
            $items[$id]['quantity'] = min($newQty, $stock);
        } else {
            $items[$id] = [
                'id' => $id,
                'name' => $phone->getName(),
                'brand' => $phone->getBrand(),
                'photo_url' => $phone->getPhotoUrl(),
                'price' => $phone->getPrice(),
                'quantity' => $qty,
                'stock' => $stock,
            ];
        }

        session(['cart.items' => $items]);
        session()->flash('flash.message_key', 'messages.added_to_cart');
        session()->flash('flash.level', 'success');

        return redirect()->back();
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $request->validate([
            'quantity' => 'required|integer|min:0',
        ]);

        $items = session('cart.items', []);
        if (!isset($items[$id])) {
            return redirect()->route('cart.index');
        }

        $phone = MobilePhone::find($id);
        $stock = $phone ? $phone->getStock() : ($items[$id]['stock'] ?? 0);

        $qty = (int) $request->input('quantity');
        if ($qty <= 0) {
            unset($items[$id]);
        } else {
            $items[$id]['quantity'] = min($qty, $stock);
        }

        session(['cart.items' => $items]);
        session()->flash('flash.message_key', 'messages.cart_updated');
        session()->flash('flash.level', 'success');

        return redirect()->route('cart.index');
    }


    public function remove(int $id): RedirectResponse
    {
        $items = session('cart.items', []);
        if (isset($items[$id])) {
            unset($items[$id]);
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
            return redirect()->route('cart.index')->with('flash.message_key', 'messages.no_results')->with('flash.level', 'warning');
        }

        $total = 0;
        $dbItems = [];
        foreach ($items as $it) {
            $phone = MobilePhone::find($it['id']);
            if (!$phone) {
                return redirect()->route('cart.index')->with('flash.message_key', 'messages.error')->with('flash.level', 'danger');
            }
            $qty = min($it['quantity'], $phone->getStock());
            if ($qty <= 0) {
                return redirect()->route('cart.index')->with('flash.message_key', 'messages.error')->with('flash.level', 'danger');
            }
            $price = $phone->getPrice();
            $total += ($price * $qty);
            $dbItems[] = ['phone' => $phone, 'qty' => $qty, 'price' => $price];
        }

        DB::beginTransaction();
        try {
            $order = new Order();
            $order->setDate(now()->toDateString());
            $order->setStatus('pending');
            $order->setTotal($total);
            $order->setUserId($user->getId());
            $order->save();

            foreach ($dbItems as $row) {
                $phone = $row['phone'];
                $qty = $row['qty'];
                $price = $row['price'];

                $phone->setStock($phone->getStock() - $qty);
                $phone->save();

                $item = new OrderItem();
                $item->setOrderId($order->getId());
                $item->setMobilePhoneId($phone->getId());
                $item->setQuantity($qty);
                $item->setPrice($price);
                $item->save();
            }

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->route('cart.index')->with('flash.message_key', 'messages.error')->with('flash.level', 'danger');
        }


        session()->forget('cart.items');

        return redirect()->route('order.show', ['order' => $order->getId()])
            ->with('flash.message_key', 'messages.order_created')
            ->with('flash.level', 'success');
    }
}
