<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

// Tabel auth bersama di Supabase: RLS aktif tanpa policy menutup akses REST API publik (role anon/authenticated).
// Laravel terhubung sebagai postgres (pemilik tabel, bypassrls) sehingga tidak terpengaruh.
// Diterapkan di produksi lewat Supabase MCP (20 Okt 2026); ENABLE bersifat idempoten.
return new class extends Migration
{
    protected $connection = 'supabase';

    private array $tables = [
        'users', 'password_reset_tokens', 'sessions',
        'permissions', 'roles', 'model_has_permissions', 'model_has_roles', 'role_has_permissions',
        'personal_access_tokens', 'activity_log', 'notifications',
    ];

    public function up(): void
    {
        foreach ($this->existingTables() as $table) {
            DB::connection($this->connection)->statement("ALTER TABLE public.\"$table\" ENABLE ROW LEVEL SECURITY");
        }
    }

    public function down(): void
    {
        // Tabel pusat di Supabase dipakai semua app: rollback dari satu app tidak boleh menghapus/mengubahnya
    }

    // activity_log & notifications dibuat oleh migration clip, jadi bisa belum ada di instalasi baru money
    private function existingTables(): array
    {
        return array_filter($this->tables, fn (string $table) => Schema::connection($this->connection)->hasTable($table));
    }
};
