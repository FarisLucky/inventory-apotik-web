<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembeliansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembelians', function (Blueprint $table) {
            $table->id();
            $table->string('no_faktur', 10)->nullable();
            $table->dateTime('tgl_jatuh_tempo')->nullable();
            $table->dateTime('tgl_transaksi')->nullable();
            $table->tinyInteger('id_supplier')->nullable();
            $table->tinyInteger('id_akun')->nullable();
            $table->Integer('total')->nullable();
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
        Schema::dropIfExists('pembelians');
    }
}
