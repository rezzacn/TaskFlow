<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('client_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->string('nama_project');
            $table->string('deskripsi')->nullable();
            $table->decimal('harga', 15, 2);

            $table->enum('pembayaran_tipe', [
                'DP',
                'Full',
                'Lunas'
            ]);

            $table->enum('status', [
                'ToDo',
                'InProgress',
                'Done'
            ])->default('ToDo');
            $table->date('tgl_mulai')->nullable();
            $table->date('deadline')->nullable();
            $table->string('bukti_tf')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
