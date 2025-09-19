<?php

namespace App\Models;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Validator as ValidatorFacade;

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
     */
    public static function validate(array $data): Validator
    {
        return ValidatorFacade::make($data, [
            'id' => 'required|string|unique:users,id',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
            'staff' => 'boolean',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
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

    public function isStaff(): bool
    {
        return $this->staff;
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
