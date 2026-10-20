<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaction_names', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            // users ada di koneksi supabase, jadi tanpa foreign key lintas database
            $table->foreignId('user_id')->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaction_names');
    }
};
