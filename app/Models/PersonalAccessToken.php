<?php

namespace App\Models;

use Laravel\Sanctum\PersonalAccessToken as SanctumPersonalAccessToken;

class PersonalAccessToken extends SanctumPersonalAccessToken
{
    // Token API ikut tabel users di Supabase
    protected $connection = 'supabase';
}
