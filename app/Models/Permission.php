<?php

namespace App\Models;

use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
    // Data role & permission terpusat di Supabase
    protected $connection = 'supabase';
}
