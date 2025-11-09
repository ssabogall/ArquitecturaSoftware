<?php

/**
 * Review.php
 *
 * Model for product reviews (MobilePhone) made by users.
 *
 * @author Miguel Arcila
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;

/**
 * REVIEW ATTRIBUTES
 *
 * $this->attributes['id'] - int - contains the review primary key
 * $this->attributes['user_id'] - int - references users.id
 * $this->attributes['mobile_phone_id'] - int - references mobile_phones.id
 * $this->attributes['status'] - string - enum: pending, approved, rejected
 * $this->attributes['rating'] - int - rating value (1..5)
 * $this->attributes['comments'] - string|null - optional comments
 * $this->attributes['created_at'] - Carbon - creation date
 * $this->attributes['updated_at'] - Carbon - last update date
 * $this->user - User - contains the review owner
 * $this->mobilePhone - MobilePhone - contains the reviewed mobile phone
 */
class Review extends Model
{
    protected $fillable = [
        'user_id',
        'mobile_phone_id',
        'status',
        'rating',
        'comments',
    ];

    // Getters
    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getUserId(): int
    {
        return $this->attributes['user_id'];
    }

    public function getMobilePhoneId(): int
    {
        return $this->attributes['mobile_phone_id'];
    }

    public function getStatus(): string
    {
        return $this->attributes['status'];
    }

    public function getRating(): int
    {
        return $this->attributes['rating'];
    }

    public function getComments(): ?string
    {
        return $this->attributes['comments'] ?? null;
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
    public function setUserId(int $userId): void
    {
        $this->attributes['user_id'] = $userId;
    }

    public function setMobilePhoneId(int $mobilePhoneId): void
    {
        $this->attributes['mobile_phone_id'] = $mobilePhoneId;
    }

    public function setStatus(string $status): void
    {
        $this->attributes['status'] = $status;
    }

    public function setRating(int $rating): void
    {
        $this->attributes['rating'] = $rating;
    }

    public function setComments(?string $comments): void
    {
        $this->attributes['comments'] = $comments;
    }

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getUser(): ?User
    {
        return $this->user;
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
            'user_id' => 'required|integer|exists:users,id',
            'mobile_phone_id' => 'required|integer|exists:mobile_phones,id',
            'status' => 'required|in:pending,approved,rejected',
            'rating' => 'required|integer|min:1|max:5',
            'comments' => 'nullable|string|max:1000',
        ]);
    }
}