<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRawatInapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rawat_inaps', function (Blueprint $table) {
            $table->unsignedBigInteger('dokter_id');
            $table->foreign('dokter_id')->references('dokter_id')->on('dokters')->onDelete('cascade');
            $table->unsignedBigInteger('kamar_id');
            $table->foreign('kamar_id')->references('kamar_id')->on('kamars')->onDelete('cascade');
            $table->string('nama_pasien');
            $table->string('usia');
            $table->date('tanggal_lahir');
            $table->string('jenis_kelamin');
            $table->date('tanggal_masuk');
            $table->date('tanggal_keluar')->nullable();
            $table->unsignedBigInteger('diagnosa_utama');
            $table->foreign('diagnosa_utama')->references('id')->on('diagnoses')->onDelete('cascade');
            $table->unsignedBigInteger('diagnosa_kedua')->nullable();
            $table->foreign('diagnosa_kedua')->references('id')->on('diagnoses')->onDelete('cascade');
            $table->string('nama_operasi_1')->nullable();
            $table->string('nama_operasi_2')->nullable();
            $table->date('tanggal_operasi')->nullable();
            $table->string('status_keadaan_keluar');
            $table->boolean('selesai')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rawat_inaps');
    }
}
