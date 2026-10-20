<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('feedbacks', function (Blueprint $table) {
            $table->id();
            // users ada di koneksi supabase, jadi tanpa foreign key lintas database
            $table->foreignId('user_id')->index();
            $table->enum('type', ['kritik', 'saran']);
            $table->string('title');
            $table->text('message');
            $table->enum('status', ['pending', 'reviewed', 'resolved'])->default('pending');
            $table->text('admin_notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('feedbacks');
    }
};
