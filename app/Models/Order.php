<?php

/**
 * Order.php
 *
 * Modelo para las órdenes.
 *
 * @author Alejandro Carmona
 * @author Miguel Arcila
 *
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;

/**
 * ORDER ATTRIBUTES
 * $this->attributes['id'] - int - primary key
 * $this->attributes['date'] - string (Y-m-d) - order date
 * $this->attributes['status'] - string - pending|paid|shipped|cancelled
 * $this->attributes['total'] - int - total amount
 * $this->attributes['user_id'] - int - owner user id
 * $this->items - OrderItem[] - associated items
 * $this->attributes['created_at'] - Carbon
 * $this->attributes['updated_at'] - Carbon
 */
class Order extends Model
{
    protected $fillable = [
        'date',
        'status',
        'user_id',
        'total',
    ];

    public static function validate(Request $request): void
    {
        $request->validate([
            'date' => 'required|date',
            'status' => 'required|in:pending,paid,shipped,cancelled',
            'total' => 'required|integer|min:0',
            'user_id' => 'required|integer|exists:users,id',
        ], [
            'date.required' => 'La fecha de la orden es obligatoria.',
            'date.date' => 'La fecha de la orden debe tener un formato válido (Y-m-d).',
            'status.required' => 'El estado de la orden es obligatorio.',
            'status.in' => 'El estado de la orden debe ser pending, paid, shipped o cancelled.',
            'total.required' => 'El total de la orden es obligatorio.',
            'total.integer' => 'El total de la orden debe ser un número entero.',
            'total.min' => 'El total de la orden no puede ser negativo.',
            'user_id.required' => 'El usuario es obligatorio.',
            'user_id.integer' => 'El usuario debe ser un identificador numérico.',
            'user_id.exists' => 'El usuario especificado no existe.',
        ]);
    }

    // Relaciones
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

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

    public function getTotalFormatted(): string
    {
        return number_format($this->getTotal(), 0, ',', '.');
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
}