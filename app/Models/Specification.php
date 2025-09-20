<?php

/**
 * Specification.php
 *
 * Modelo para especificaciones técnicas de un MobilePhone.
 *
 * @author Miguel Arcila
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;

/**
 * SPECIFICATION ATTRIBUTES
 * $this->attributes['id'] - int - contains the specification primary key
 * $this->attributes['mobile_phone_id'] - int - references mobile_phones.id
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
        ], [
            'mobile_phone_id.required' => 'El teléfono móvil es obligatorio.',
            'mobile_phone_id.integer' => 'El identificador del teléfono debe ser un número entero.',
            'mobile_phone_id.exists' => 'El teléfono móvil seleccionado no existe.',

            'model.required' => 'El modelo es obligatorio.',
            'model.string' => 'El modelo debe ser texto.',
            'model.max' => 'El modelo no puede superar los 255 caracteres.',

            'processor.required' => 'El procesador es obligatorio.',
            'processor.string' => 'El procesador debe ser texto.',
            'processor.max' => 'El procesador no puede superar los 255 caracteres.',

            'battery.required' => 'La batería es obligatoria.',
            'battery.integer' => 'La batería debe ser un número entero (mAh).',
            'battery.min' => 'La batería no puede ser negativa.',

            'screen_size.required' => 'El tamaño de pantalla es obligatorio.',
            'screen_size.numeric' => 'El tamaño de pantalla debe ser numérico.',
            'screen_size.min' => 'El tamaño de pantalla no puede ser negativo.',

            'screen_tech.required' => 'La tecnología de pantalla es obligatoria.',
            'screen_tech.string' => 'La tecnología de pantalla debe ser texto.',
            'screen_tech.max' => 'La tecnología de pantalla no puede superar los 255 caracteres.',

            'ram.required' => 'La memoria RAM es obligatoria.',
            'ram.integer' => 'La RAM debe ser un número entero (GB).',
            'ram.min' => 'La RAM no puede ser negativa.',

            'storage.required' => 'El almacenamiento es obligatorio.',
            'storage.integer' => 'El almacenamiento debe ser un número entero (GB).',
            'storage.min' => 'El almacenamiento no puede ser negativo.',

            'camera_specs.string' => 'Las especificaciones de la cámara deben ser texto.',
            'camera_specs.max' => 'Las especificaciones de la cámara no pueden superar los 1000 caracteres.',

            'color.required' => 'El color es obligatorio.',
            'color.string' => 'El color debe ser texto.',
            'color.max' => 'El color no puede superar los 100 caracteres.',
        ]);
    }

    // Relación
    public function mobilePhone(): BelongsTo
    {
        return $this->belongsTo(MobilePhone::class, 'mobile_phone_id');
    }

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
}