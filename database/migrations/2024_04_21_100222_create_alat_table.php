<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alat', function (Blueprint $table) {
            $table->integer('alat_id')->autoIncrement()->primary();
            $table->integer('alat_kategori_id')->nullable(false);
            $table->string('alat_nama', 150)->nullable(false);
            $table->string('alat_deskripsi', 255)->nullable(false);
            $table->integer('alat_hargaperhari')->nullable(false);
            $table->integer('alat_stok')->nullable(false);

            $table->foreign('alat_kategori_id')->references('kategori_id')->on('kategori')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alat');
    }
}