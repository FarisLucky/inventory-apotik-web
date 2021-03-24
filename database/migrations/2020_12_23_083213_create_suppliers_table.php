<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->tinyInteger('id_supplier', true, true);
            $table->string('no_pbf', 50)->nullable();
            $table->string('nama_supplier', 100)->nullable();
            $table->string('alamat', 35)->nullable();
            $table->string('telp', 15)->nullable();
            $table->string('fax', 15)->nullable();
            $table->string('email', 50)->nullable();
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
        Schema::dropIfExists('suppliers');
    }
}
