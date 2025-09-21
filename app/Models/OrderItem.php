<?php

/**
 * OrderItem.php
 *
 * Modelo para los ítems de una orden (carrito y checkout).
 * Un OrderItem pertenece a una Order y a un MobilePhone.
 *
 * @author Miguel Arcila
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;

/**
 * ORDER ITEM ATTRIBUTES
 * $this->attributes['id'] - int - contains the order item primary key
 * $this->attributes['order_id'] - int - references orders.id
 * $this->attributes['mobile_phone_id'] - int - references mobile_phones.id
 * $this->attributes['quantity'] - int - quantity of items
 * $this->attributes['price'] - int - unit price at purchase time (cents or integer)
 * $this->attributes['created_at'] - Carbon - creation date
 * $this->attributes['updated_at'] - Carbon - last update date
 */
class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'mobile_phone_id',
        'quantity',
        'price',
    ];

    public static function validate(Request $request): void
    {
        $request->validate([
            'order_id' => 'required|integer|exists:orders,id',
            'mobile_phone_id' => 'required|integer|exists:mobile_phones,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|integer|min:0',
        ], [
            'order_id.required' => 'La orden es obligatoria.',
            'order_id.integer' => 'La orden debe ser un identificador numérico.',
            'order_id.exists' => 'La orden seleccionada no existe.',

            'mobile_phone_id.required' => 'El producto es obligatorio.',
            'mobile_phone_id.integer' => 'El producto debe ser un identificador numérico.',
            'mobile_phone_id.exists' => 'El producto seleccionado no existe.',

            'quantity.required' => 'La cantidad es obligatoria.',
            'quantity.integer' => 'La cantidad debe ser un número entero.',
            'quantity.min' => 'La cantidad mínima es 1.',

            'price.required' => 'El precio es obligatorio.',
            'price.integer' => 'El precio debe ser un número entero.',
            'price.min' => 'El precio no puede ser negativo.',
        ]);
    }

    // Relaciones
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function mobilePhone(): BelongsTo
    {
        return $this->belongsTo(MobilePhone::class, 'mobile_phone_id');
    }

    // Getters
    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getOrderId(): int
    {
        return $this->attributes['order_id'];
    }

    public function getMobilePhoneId(): int
    {
        return $this->attributes['mobile_phone_id'];
    }

    public function getQuantity(): int
    {
        return $this->attributes['quantity'];
    }

    public function getPrice(): int
    {
        return $this->attributes['price'];
    }

    public function getCreatedAt(): string
    {
        return (string) $this->attributes['created_at'];
    }

    public function getUpdatedAt(): string
    {
        return (string) $this->attributes['updated_at'];
    }

    // Setters
    public function setOrderId(int $orderId): void
    {
        $this->attributes['order_id'] = $orderId;
    }

    public function setMobilePhoneId(int $mobilePhoneId): void
    {
        $this->attributes['mobile_phone_id'] = $mobilePhoneId;
    }

    public function setQuantity(int $quantity): void
    {
        $this->attributes['quantity'] = $quantity;
    }

    public function setPrice(int $price): void
    {
        $this->attributes['price'] = $price;
    }
}
