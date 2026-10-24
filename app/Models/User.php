<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\LogsOutOtherDevicesOnPasswordChange;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasRoles, HasApiTokens, LogsOutOtherDevicesOnPasswordChange;

    // Data auth terpusat di Supabase, data keuangan tetap di MySQL
    protected $connection = 'supabase';

    public function hasVerifiedEmail(): bool
    {
        if ($this->hasAnyRole([config('access.super_admin_role'), 'money.admin'])) {
            return true;
        }
        return !is_null($this->email_verified_at);
    }

    // User yang punya akses ke app ini: role "<app>.*", super-admin, atau permission "<app>.access" langsung
    public function scopeWithAppAccess(Builder $query): Builder
    {
        $app = config('access.app');

        return $query->where(fn (Builder $q) => $q
            ->whereHas('roles', fn (Builder $r) => $r->where(fn (Builder $x) => $x
                ->where('name', 'like', $app.'.%')
                ->orWhere('name', config('access.super_admin_role'))))
            ->orWhereHas('permissions', fn (Builder $p) => $p->where('name', $app.'.access')));
    }

    // Ganti role milik app ini saja; role app lain (mis. clip.*) dan super-admin tetap
    public function syncAppRoles(array $roles): void
    {
        $others = $this->roles->pluck('name')
            ->reject(fn (string $name) => str_starts_with($name, Role::appPrefix()))
            ->all();

        $this->syncRoles([...$others, ...$roles]);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
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
        ];
    }
}
