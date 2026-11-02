<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            // Message-Id email notifikasi bank, untuk menolak email yang sama diimpor dua kali
            $table->string('email_message_id')->nullable()->after('description');
            $table->unique(['user_id', 'email_message_id']);
        });
    }

    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropUnique(['user_id', 'email_message_id']);
            $table->dropColumn('email_message_id');
        });
    }
};
