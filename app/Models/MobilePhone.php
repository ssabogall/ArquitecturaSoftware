<?php

/**
 * MobilePhone.php
 *
 * Modelo para MobilePhone.
 *
 * @author Alejandro Carmona
 * @author Miguel Arcila
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Http\Request;

/**
 * MOBILE PHONE ATTRIBUTES
 * $this->attributes['id'] - int - contains the mobile phone primary key
 * $this->attributes['name'] - string - contains the mobile phone name
 * $this->attributes['photo_url'] - string|null - contains the photo URL
 * $this->attributes['brand'] - string - contains the brand of the phone
 * $this->attributes['price'] - int - contains the price of the phone
 * $this->attributes['stock'] - int - contains the available stock
 * $this->attributes['created_at'] - Carbon - contains the creation date
 * $this->attributes['updated_at'] - Carbon - contains the last update date
 */
class MobilePhone extends Model
{
    protected $fillable = [
        'name',
        'photo_url',
        'brand',
        'price',
        'stock',
    ];

    public static function validate(Request $request): void
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'photo_url' => 'nullable|url',
            'brand' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'name.string' => 'El nombre debe ser una cadena de texto.',
            'name.max' => 'El nombre no puede superar los 255 caracteres.',

            'photo_url.url' => 'La URL de la foto debe ser válida.',

            'brand.required' => 'La marca es obligatoria.',
            'brand.string' => 'La marca debe ser texto.',
            'brand.max' => 'La marca no puede superar los 255 caracteres.',

            'price.required' => 'El precio es obligatorio.',
            'price.integer' => 'El precio debe ser un número entero.',
            'price.min' => 'El precio no puede ser negativo.',

            'stock.required' => 'El stock es obligatorio.',
            'stock.integer' => 'El stock debe ser un número entero.',
            'stock.min' => 'El stock no puede ser negativo.',
        ]);
    }

    // Relaciones
    public function specification(): HasOne
    {
        return $this->hasOne(Specification::class, 'mobile_phone_id');
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'mobile_phone_id');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'mobile_phone_id');
    }

    // Getters
    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getName(): string
    {
        return $this->attributes['name'];
    }

    public function getPhotoUrl(): ?string
    {
        return $this->attributes['photo_url'];
    }

    public function getBrand(): string
    {
        return $this->attributes['brand'];
    }

    public function getPrice(): int
    {
        return $this->attributes['price'];
    }

    public function getPriceFormatted(): string
    {
        return number_format($this->getPrice(), 0, ',', '.');
    }

    public function getStock(): int
    {
        return $this->attributes['stock'];
    }

    public function getCreatedAt(): string
    {
        return (string) $this->attributes['created_at'];
    }

    public function getUpdatedAt(): string
    {
        return (string) $this->attributes['updated_at'];
    }

    public function getApprovedReviewsAvgRating(): ?float
    {
        return isset($this->attributes['approved_reviews_avg_rating'])
            ? (float) $this->attributes['approved_reviews_avg_rating']
            : null;
    }

    public function getApprovedReviewsCount(): int
    {
        return (int) ($this->attributes['approved_reviews_count'] ?? 0);
    }

    public function getApprovedReviewsAvgRatingFormatted(): ?string
    {
        $avg = $this->getApprovedReviewsAvgRating();

        return $avg !== null ? number_format($avg, 1, ',', '.') : null;
    }

    public function getPhotoFilename(): ?string
    {
        $url = $this->getPhotoUrl();
        if (! $url) {
            return null;
        }
        $path = parse_url($url, PHP_URL_PATH);
        if (is_string($path) && $path !== '') {
            return basename($path);
        }

        return basename($url);
    }

    // Setters
    public function setName(string $name): void
    {
        $this->attributes['name'] = $name;
    }

    public function setPhotoUrl(?string $photoUrl): void
    {
        $this->attributes['photo_url'] = $photoUrl;
    }

    public function setBrand(string $brand): void
    {
        $this->attributes['brand'] = $brand;
    }

    public function setPrice(int $price): void
    {
        $this->attributes['price'] = $price;
    }

    public function setStock(int $stock): void
    {
        $this->attributes['stock'] = $stock;
    }
}
