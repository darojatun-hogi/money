<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    // Data role & permission terpusat di Supabase
    protected $connection = 'supabase';

    // Role milik app ini (awalan "<app>.")
    public function scopeForApp(Builder $query): Builder
    {
        return $query->where('name', 'like', config('access.app').'.%');
    }

    public static function appPrefix(): string
    {
        return config('access.app').'.';
    }
}
