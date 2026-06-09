<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasFactory, Notifiable; 

    const ROLE_ADMIN = 'admin';
    const ROLE_GURU  = 'guru';
    const ROLE_WALAS = 'walas';

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

    public function getAuthIdentifierName(): string
    {
        return 'username';
    }

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
        if ($this->role === self::ROLE_WALAS) {
            return true;
        }

        if ($this->role === self::ROLE_GURU) {
            return DB::table('kelas')->where('nip_guru', $this->username)->exists();
        }

        return false;
    }

    public function isPengajar(): bool
    {
        return in_array($this->role, [self::ROLE_GURU, self::ROLE_WALAS]) || $this->isWalas();
    }

    public function hasRole(string|array $roles): bool
    {
        $currentRole = $this->role;
        
        if ($currentRole === self::ROLE_GURU && $this->isWalas()) {
            $currentRole = self::ROLE_WALAS;
        }

        return in_array($currentRole, (array) $roles);
    }
}