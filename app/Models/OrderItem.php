<?php

/**
 * OrderItem.php
 *
 * Model for order items (cart and checkout).
 * An OrderItem belongs to an Order and a MobilePhone.
 *
 * @author Miguel Arcila
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;

/**
 * ORDER ITEM ATTRIBUTES
 *
 * $this->attributes['id'] - int - contains the order item primary key
 * $this->attributes['order_id'] - int - references orders.id
 * $this->attributes['mobile_phone_id'] - int - references mobile_phones.id
 * $this->attributes['quantity'] - int - quantity of items
 * $this->attributes['price'] - int - unit price at purchase time
 * $this->attributes['created_at'] - Carbon - creation date
 * $this->attributes['updated_at'] - Carbon - last update date
 * $this->order - Order - contains the parent order
 * $this->mobilePhone - MobilePhone - contains the associated mobile phone
 */
class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'mobile_phone_id',
        'quantity',
        'price',
    ];

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

    // Relationships
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function getOrder(): ?Order
    {
        return $this->order;
    }

    public function mobilePhone(): BelongsTo
    {
        return $this->belongsTo(MobilePhone::class, 'mobile_phone_id');
    }

    public function getMobilePhone(): ?MobilePhone
    {
        return $this->mobilePhone;
    }

    // Validations
    public static function validate(Request $request): void
    {
        $request->validate([
            'order_id' => 'required|integer|exists:orders,id',
            'mobile_phone_id' => 'required|integer|exists:mobile_phones,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|integer|min:0',
        ]);
    }

    // Helper methods
    public function getPriceFormatted(): string
    {
        return number_format($this->getPrice(), 0, ',', '.');
    }

    public function getSubtotal(): int
    {
        return $this->getPrice() * $this->getQuantity();
    }

    public function getSubtotalFormatted(): string
    {
        return number_format($this->getSubtotal(), 0, ',', '.');
    }
}
