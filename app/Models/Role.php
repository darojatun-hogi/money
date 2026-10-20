<?php

namespace App\Models;

use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    // Data role & permission terpusat di Supabase
    protected $connection = 'supabase';
}
