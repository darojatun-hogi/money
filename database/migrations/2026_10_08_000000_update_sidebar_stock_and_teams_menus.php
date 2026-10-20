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
    }

    public function down(): void
    {
        DB::table('menus')
            ->where('route_name', 'stock')
            ->where('name', 'Saham')
            ->update(['name' => 'Stock']);
    }
};
