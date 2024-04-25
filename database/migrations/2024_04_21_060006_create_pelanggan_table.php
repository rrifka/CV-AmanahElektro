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
        Schema::create('pelanggan', function (Blueprint $table) {
            $table->integer('pelanggan_id')->autoIncrement()->primary();
            $table->string('pelanggan_nama', 150)->nullable(false);
            $table->string('pelanggan_alamat', 200)->nullable(false);
            $table->char('pelanggan_notelp', 13)->nullable(false);
            $table->string('pelanggan_email', 100)->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelanggan');
    }
};
