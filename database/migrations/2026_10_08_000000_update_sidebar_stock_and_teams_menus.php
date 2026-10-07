<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('menus')
            ->where('route_name', 'stock')
            ->where('name', 'Stock')
            ->update(['name' => 'Saham']);

        DB::table('menus')
            ->where('route_name', 'teams.index')
            ->where('name', 'Teams')
            ->update(['is_active' => false]);
    }

    public function down(): void
    {
        DB::table('menus')
            ->where('route_name', 'stock')
            ->where('name', 'Saham')
            ->update(['name' => 'Stock']);

        DB::table('menus')
            ->where('route_name', 'teams.index')
            ->where('name', 'Teams')
            ->where('is_active', false)
            ->update(['is_active' => true]);
    }
};
