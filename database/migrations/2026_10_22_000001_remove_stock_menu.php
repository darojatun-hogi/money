<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

// Menu Saham pindah ke app tersendiri (stock.elips.id); /stock di money hanya mengarahkan ke sana
return new class extends Migration
{
    public function up(): void
    {
        DB::table('menus')->where('route_name', 'stock')->delete();
    }

    public function down(): void
    {
        DB::table('menus')->updateOrInsert(['route_name' => 'stock'], [
            'name' => 'Saham',
            'icon' => 'tabler:chart-line',
            'parent_id' => null,
            'group' => 'Finance',
            'sort_order' => 4,
            'is_active' => true,
            'permission_name' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
};
