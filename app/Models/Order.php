<?php

/**
 * Order.php
 *
 * Model for orders.
 *
 * @author Alejandro Carmona
 * @author Miguel Arcila
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;

/**
 * ORDER ATTRIBUTES
 *
 * $this->attributes['id'] - int - primary key
 * $this->attributes['date'] - string (Y-m-d) - order date
 * $this->attributes['status'] - string - enum [pending, paid, shipped, cancelled]
 * $this->attributes['total'] - int - total amount
 * $this->attributes['created_at'] - Carbon - contains the creation date
 * $this->attributes['updated_at'] - Carbon - contains the last update date
 * $this->items - collection - contains the associated items
 * $this->user - User - contains the order owner
 */
class Order extends Model
{
    protected $fillable = [
        'date',
        'status',
        'user_id',
        'total',
    ];

    // Getters
    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getUserId(): int
    {
        return (int) ($this->attributes['user_id'] ?? 0);
    }

    public function getDate(): string
    {
        return $this->attributes['date'];
    }

    public function getStatus(): string
    {
        return $this->attributes['status'];
    }

    public function getTotal(): int
    {
        return $this->attributes['total'];
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
    public function setDate(string $date): void
    {
        $this->attributes['date'] = $date;
    }

    public function setStatus(string $status): void
    {
        $this->attributes['status'] = $status;
    }

    public function setTotal(int $total): void
    {
        $this->attributes['total'] = $total;
    }

    public function setUserId(int $userId): void
    {
        $this->attributes['user_id'] = $userId;
    }

    // Relationships
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    public function getItems()
    {
        return $this->items;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    // Validations
    public static function validate(Request $request): void
    {
        $request->validate([
            'date' => 'required|date',
            'status' => 'required|in:pending,paid,shipped,cancelled',
            'total' => 'required|integer|min:0',
            'user_id' => 'required|integer|exists:users,id',
        ]);
    }

    // Helper methods
    public function getTotalFormatted(): string
    {
        return number_format($this->getTotal(), 0, ',', '.');
    }
}
