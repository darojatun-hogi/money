<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
    // Data role & permission terpusat di Supabase
    protected $connection = 'supabase';

    // Permission milik app ini ditambah permission identitas yang dipakai bersama
    public function scopeForApp(Builder $query): Builder
    {
        return $query->where(fn (Builder $q) => $q
            ->where('name', 'like', config('access.app').'.%')
            ->orWhereIn('name', config('access.shared_permissions')));
    }
}
