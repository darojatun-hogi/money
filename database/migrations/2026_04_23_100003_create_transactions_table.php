<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['income', 'outcome', 'transfer']);
            $table->decimal('amount', 15, 2);
            $table->foreignId('wallet_id')->constrained()->cascadeOnDelete();
            // to_wallet_id hanya digunakan untuk transfer antar dompet
            $table->foreignId('to_wallet_id')->nullable()->constrained('wallets')->nullOnDelete();
            $table->foreignId('transaction_name_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            $table->string('description')->nullable();
            $table->date('date');
            // users ada di koneksi supabase, jadi tanpa foreign key lintas database
            $table->foreignId('user_id')->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
