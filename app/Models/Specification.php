<?php

/**
 * Specification.php
 *
 * Model for technical specifications of a MobilePhone.
 *
 * @author Miguel Arcila
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;

/**
 * SPECIFICATION ATTRIBUTES
 *
 * $this->attributes['id'] - int - contains the specification primary key
 * $this->attributes['model'] - string - phone model name
 * $this->attributes['processor'] - string - processor name
 * $this->attributes['battery'] - int - battery capacity (mAh)
 * $this->attributes['screen_size'] - float - screen size in inches
 * $this->attributes['screen_tech'] - string - screen technology
 * $this->attributes['ram'] - int - RAM in GB
 * $this->attributes['storage'] - int - storage in GB
 * $this->attributes['camera_specs'] - string|null - camera specs description
 * $this->attributes['color'] - string - color name
 * $this->attributes['created_at'] - Carbon - creation date
 * $this->attributes['updated_at'] - Carbon - last update date
 * $this->mobilePhone - MobilePhone - contains the associated mobile phone
 */
class Specification extends Model
{
    protected $fillable = [
        'mobile_phone_id',
        'model',
        'processor',
        'battery',
        'screen_size',
        'screen_tech',
        'ram',
        'storage',
        'camera_specs',
        'color',
    ];

    // Getters
    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getMobilePhoneId(): int
    {
        return $this->attributes['mobile_phone_id'];
    }

    public function getModel(): string
    {
        return $this->attributes['model'];
    }

    public function getProcessor(): string
    {
        return $this->attributes['processor'];
    }

    public function getBattery(): int
    {
        return $this->attributes['battery'];
    }

    public function getScreenSize(): float
    {
        return (float) $this->attributes['screen_size'];
    }

    public function getScreenTech(): string
    {
        return $this->attributes['screen_tech'];
    }

    public function getRam(): int
    {
        return $this->attributes['ram'];
    }

    public function getStorage(): int
    {
        return $this->attributes['storage'];
    }

    public function getCameraSpecs(): ?string
    {
        return $this->attributes['camera_specs'] ?? null;
    }

    public function getColor(): string
    {
        return $this->attributes['color'];
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
    public function setMobilePhoneId(int $mobilePhoneId): void
    {
        $this->attributes['mobile_phone_id'] = $mobilePhoneId;
    }

    public function setModel(string $model): void
    {
        $this->attributes['model'] = $model;
    }

    public function setProcessor(string $processor): void
    {
        $this->attributes['processor'] = $processor;
    }

    public function setBattery(int $battery): void
    {
        $this->attributes['battery'] = $battery;
    }

    public function setScreenSize(float $screenSize): void
    {
        $this->attributes['screen_size'] = $screenSize;
    }

    public function setScreenTech(string $screenTech): void
    {
        $this->attributes['screen_tech'] = $screenTech;
    }

    public function setRam(int $ram): void
    {
        $this->attributes['ram'] = $ram;
    }

    public function setStorage(int $storage): void
    {
        $this->attributes['storage'] = $storage;
    }

    public function setCameraSpecs(?string $cameraSpecs): void
    {
        $this->attributes['camera_specs'] = $cameraSpecs;
    }

    public function setColor(string $color): void
    {
        $this->attributes['color'] = $color;
    }

    // Relationships
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
            'mobile_phone_id' => 'required|integer|exists:mobile_phones,id',
            'model' => 'required|string|max:255',
            'processor' => 'required|string|max:255',
            'battery' => 'required|integer|min:0',
            'screen_size' => 'required|numeric|min:0',
            'screen_tech' => 'required|string|max:255',
            'ram' => 'required|integer|min:0',
            'storage' => 'required|integer|min:0',
            'camera_specs' => 'nullable|string|max:1000',
            'color' => 'required|string|max:100',
        ]);
    }
}
