<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePelangganDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pelanggan_data', function (Blueprint $table) {
            $table->integer('pelanggan_data_id')->autoIncrement()->primary();
            $table->integer('pelanggan_data_pelanggan_id')->nullable(false);
            $table->enum('pelanggan_data_jenis', ['KTP','SIM'])->nullable(false);
            $table->string('pelanggan_data_file', 255)->nullable(false);
            $table->timestamps();

            $table->foreign('pelanggan_data_pelanggan_id')->references('pelanggan_id')->on('pelanggan')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pelanggan_data');
    }
}
