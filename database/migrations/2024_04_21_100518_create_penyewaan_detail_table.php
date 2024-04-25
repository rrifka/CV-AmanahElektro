<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenyewaanDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penyewaan_detail', function (Blueprint $table) {
            $table->integer('penyewaan_detail_id')->autoIncrement()->primary();
            $table->integer('penyewaan_detail_penyewaan_id')->nullable(false);
            $table->integer('penyewaan_detail_alat_id')->nullable(false);
            $table->integer('penyewaan_detail_jumlah')->nullable(false);
            $table->integer('penyewaan_detail_subharga')->nullable(false);

            $table->foreign('penyewaan_detail_penyewaan_id')->references('penyewaan_id')->on('penyewaan')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('penyewaan_detail_alat_id')->references('alat_id')->on('alat')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penyewaan_detail');
    }
}