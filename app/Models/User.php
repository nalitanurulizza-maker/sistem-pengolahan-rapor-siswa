<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // <-- 1. IMPORT INI WAJIB ADA
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable; // <-- 2. PASANG HASFACTORY DI SINI

    const ROLE_ADMIN = 'Admin';
    const ROLE_GURU  = 'Guru';
    const ROLE_WALAS = 'Walas';

    protected $fillable = [
        'name',
        'username',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password'   => 'hashed',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // ── WAJIB DITAMBAHKAN ─────────────────────────────────────────────────────
    /**
     * Override default 'email' menjadi 'username' untuk Auth::attempt()
     */
    public function getAuthIdentifierName(): string
    {
        return 'username';
    }
    // ─────────────────────────────────────────────────────────────────────────

    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isGuru(): bool
    {
        return $this->role === self::ROLE_GURU;
    }

    public function isWalas(): bool
    {
        return $this->role === self::ROLE_WALAS;
    }

    public function isPengajar(): bool
    {
        return in_array($this->role, [self::ROLE_GURU, self::ROLE_WALAS]);
    }

    public function hasRole(string|array $roles): bool
    {
        return in_array($this->role, (array) $roles);
    }
}