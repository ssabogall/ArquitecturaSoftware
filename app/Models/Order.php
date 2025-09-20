<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

/**
 * ORDER ATTRIBUTES
 * $this->attributes['id'] - string - contains the order primary key (UUID)
 * $this->attributes['date'] - string - contains the order date (Y-m-d)
 * $this->attributes['status'] - string - contains the order status (pending, paid, shipped, cancelled)
 * $this->attributes['total'] - int - contains the total amount of the order
 * $this->items - OrderItem[] - contains the associated order items
 * $this->attributes['created_at'] - Carbon - contains the creation date
 * $this->attributes['updated_at'] - Carbon - contains the last update date
 */
class Order extends Model
{
    protected $fillable = [
        'date',
        'status',
        'total',
    ];

    public static function validate(Request $request): void
    {
        $request->validate([
            'date' => 'required|date',
            'status' => 'required|in:pending,paid,shipped,cancelled',
            'total' => 'required|integer|min:0',
        ], [
            'date.required' => 'La fecha de la orden es obligatoria.',
            'date.date' => 'La fecha de la orden debe tener un formato válido (Y-m-d).',

            'status.required' => 'El estado de la orden es obligatorio.',
            'status.in' => 'El estado de la orden debe ser pending, paid, shipped o cancelled.',

            'total.required' => 'El total de la orden es obligatorio.',
            'total.integer' => 'El total de la orden debe ser un número entero.',
            'total.min' => 'El total de la orden no puede ser negativo.',
        ]);
    }

    // Getters
    public function getId(): int
    {
        return $this->attributes['id'];
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
}
