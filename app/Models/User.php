<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasRoles, HasApiTokens;

    // Data auth terpusat di Supabase, data keuangan tetap di MySQL
    protected $connection = 'supabase';

    public function sendEmailVerificationNotification(): void
    {
        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            return (new \Illuminate\Notifications\Messages\MailMessage)
                ->subject('Verifikasi Alamat Email Anda')
                ->view('mail.verify-email', ['url' => $url, 'user' => $notifiable]);
        });

        parent::sendEmailVerificationNotification();
    }

    public function sendPasswordResetNotification($token): void
    {
        ResetPassword::toMailUsing(function ($notifiable, $token) {
            $url = url(route('password.reset', ['token' => $token, 'email' => $notifiable->email], false));

            return (new \Illuminate\Notifications\Messages\MailMessage)
                ->subject('Reset Password Akun Anda')
                ->view('mail.reset-password', ['url' => $url, 'user' => $notifiable]);
        });

        parent::sendPasswordResetNotification($token);
    }

    public function hasVerifiedEmail(): bool
    {
        if ($this->hasRole('admin')) {
            return true;
        }
        return !is_null($this->email_verified_at);
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
