<?php

/**
 * MobilePhone.php
 *
 * Model for MobilePhone.
 *
 * @author Alejandro Carmona
 * @author Miguel Arcila
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * MOBILE PHONE ATTRIBUTES
 *
 * $this->attributes['id'] - int - contains the mobile phone primary key
 * $this->attributes['name'] - string - contains the mobile phone name
 * $this->attributes['photo_url'] - string|null - contains the photo URL
 * $this->attributes['brand'] - string - contains the brand of the phone
 * $this->attributes['price'] - int - contains the price of the phone
 * $this->attributes['stock'] - int - contains the available stock
 * $this->attributes['created_at'] - Carbon - contains the creation date
 * $this->attributes['updated_at'] - Carbon - contains the last update date
 * $this->specification - Specification - contains the associated specification
 * $this->orderItems - collection - contains the order items for this mobile phone
 * $this->reviews - collection - contains the reviews for this mobile phone
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
        $value = $this->attributes['photo_url'] ?? null;
        if (empty($value)) {
            return null;
        }

        if (Str::startsWith($value, ['http://', 'https://', 'data:'])) {
            return $value;
        }

        $path = ltrim($value, '/');

        if (Str::startsWith($path, 'storage/')) {
            return asset($path);
        }

        if (Storage::disk('public')->exists($path)) {
            return asset('storage/'.$path);
        }

        if (file_exists(public_path($path))) {
            return asset($path);
        }

        return asset($path);
    }

    public function getBrand(): string
    {
        return $this->attributes['brand'];
    }

    public function getPrice(): int
    {
        return $this->attributes['price'];
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

    // Relationships
    public function specification(): HasOne
    {
        return $this->hasOne(Specification::class, 'mobile_phone_id');
    }

    public function getSpecification(): ?Specification
    {
        return $this->specification;
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'mobile_phone_id');
    }

    public function getOrderItems()
    {
        return $this->orderItems;
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'mobile_phone_id');
    }

    public function getReviews()
    {
        return $this->reviews;
    }

    // Validations
    public static function validate(Request $request): void
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'photo_url' => 'nullable|string|max:2048',
            'brand' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
        ]);
    }

    public static function validateAddToCart(Request $request): void
    {
        $request->validate([
            'mobile_phone_id' => 'required|integer|exists:mobile_phones,id',
            'quantity' => 'required|integer|min:1',
        ]);
    }

    public static function validateUpdateCartItem(Request $request): void
    {
        $request->validate([
            'quantity' => 'required|integer|min:0',
        ]);
    }

    // Helper methods
    public function getPriceFormatted(): string
    {
        return number_format($this->getPrice(), 0, ',', '.');
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
}