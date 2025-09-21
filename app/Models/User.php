<?php

/**
 * User.php
 *
 * Modelo para los usuarios. Se maneja con laravel/ui.
 *
 * @author Alejandro Carmona
 * @author Miguel Arcila
 *
 */

namespace App\Models;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Validator as ValidatorFacade;
use Illuminate\Http\Request;

/**
 * USER ATTRIBUTES
 * $this->attributes['id'] - string - contains the user primary key (UUID)
 * $this->attributes['name'] - string - contains the user name
 * $this->attributes['email'] - string - contains the user email
 * $this->attributes['password'] - string - contains the user hashed password
 * $this->attributes['staff'] - bool - indicates if the user is staff
 * $this->attributes['phone'] - string|null - contains the user phone number
 * $this->attributes['address'] - string|null - contains the user address
 * $this->attributes['created_at'] - Carbon - contains the creation date
 * $this->attributes['updated_at'] - Carbon - contains the last update date
 */
class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'staff',
        'phone',
        'address',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Cast attributes
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Validate user data
     *
     * @param  array<string, mixed>  $data
     * @param  int|null  $ignoreId  If provided, email uniqueness will ignore this user id (update scenario)
     */
    public static function validate(array $data, ?int $ignoreId = null): Validator
    {
        $emailRule = 'required|string|email|max:255|unique:users,email';
        if ($ignoreId !== null) {
            $emailRule = 'required|string|email|max:255|unique:users,email,'.$ignoreId;
        }

        return ValidatorFacade::make($data, [
            'name' => 'required|string|max:255',
            'email' => $emailRule,
            'password' => $ignoreId === null ? 'required|string|min:8' : 'nullable|string|min:8',
            'staff' => 'boolean',
            'phone' => 'nullable|string|max:30',
            'address' => 'nullable|string|max:255',
        ]);
    }

    // Validate profile update data (name, phone, address)
    public static function validateProfile(Request $request): void
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:30',
            'address' => 'nullable|string|max:255',
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'name.string' => 'El nombre debe ser texto.',
            'name.max' => 'El nombre no puede superar los 255 caracteres.',
            'phone.string' => 'El teléfono debe ser texto.',
            'phone.max' => 'El teléfono no puede superar los 30 caracteres.',
            'address.string' => 'La dirección debe ser texto.',
            'address.max' => 'La dirección no puede superar los 255 caracteres.',
        ]);
    }

    // Getters
    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getStaff(): bool
    {
        return $this->staff;
    }

    public function isStaff(): bool
    {
        return $this->getStaff();
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function getAddress(): ?string
    {
        return $this->address;
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
    public function setName(string $name): void
    {
        $this->attributes['name'] = $name;
    }

    public function setEmail(string $email): void
    {
        $this->attributes['email'] = $email;
    }

    public function setPassword(string $password): void
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function setStaff(bool $staff): void
    {
        $this->attributes['staff'] = $staff;
    }

    public function setPhone(?string $phone): void
    {
        $this->attributes['phone'] = $phone;
    }

    public function setAddress(?string $address): void
    {
        $this->attributes['address'] = $address;
    }
}
