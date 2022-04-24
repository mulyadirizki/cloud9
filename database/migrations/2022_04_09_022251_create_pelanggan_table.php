<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePelangganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pelanggan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pelanggan', 50);
            $table->foreignId('area_id')->unsigned();
            $table->foreign('area_id')->references('id')->on('area');
            $table->text('alamat');
            $table->string('tagihan', 50);
            $table->string('paket', 30);
            $table->string('merk_modem', 50);
            $table->string('sn_modem', 30);
            $table->string('tv');
            $table->string('sn', 50);
            $table->string('chip_id', 50);
            $table->date('tgl_pemasangan');
            $table->string('tgl_tagihan', 30);
            $table->string('merk_modem', 100);
            $table->string('telp_hp', 15);
            $table->string('user_id', 50);
            $table->string('password', 100);
            $table->int('status', 4);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pelanggan');
    }
}
