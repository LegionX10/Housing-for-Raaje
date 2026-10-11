<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Every role in the system and the label shown on screen.
     */
    public const ROLES = [
        'admin' => 'System Administrator',
        'manager' => 'Branch Manager',
        'specialist' => 'Property Specialist',
        'receptionist' => 'Receptionist',
        'owner' => 'Property Owner',
        'client' => 'Client',
    ];

    /**
     * The roles that count as internal staff.
     */
    public const STAFF_ROLES = ['admin', 'manager', 'specialist', 'receptionist'];

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'role',
        'branch_id',
        'is_verified',
        'national_id',
        'bank_name',
        'bank_account',
        'sex',
        'date_of_birth',
        'max_rent',
        'preferred_location',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_verified' => 'boolean',
            'date_of_birth' => 'date',
        ];
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    /**
     * Apartments this user owns (owners only).
     */
    public function apartments(): HasMany
    {
        return $this->hasMany(Apartment::class, 'owner_id');
    }

    public function isStaff(): bool
    {
        return in_array($this->role, self::STAFF_ROLES);
    }

    /**
     * The label for this user's role, e.g. "Property Owner".
     */
    public function roleLabel(): string
    {
        return self::ROLES[$this->role];
    }

    /**
     * The first letters of the name, shown in the sidebar avatar.
     */
    public function initials(): string
    {
        $words = explode(' ', $this->name);

        return strtoupper(substr($words[0], 0, 1).substr($words[1] ?? '', 0, 1));
    }

    /**
     * The route name of the page this user lands on after login.
     */
    public function homeRoute(): string
    {
        return match ($this->role) {
            'owner' => 'owner.dashboard',
            'client' => 'client.search',
            'admin' => 'admin.staff',
            default => 'staff.dashboard',
        };
    }
}
