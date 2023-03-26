<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fiturs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('project_id');
            $table->string('nama_fitur');
            $table->string('nama_file')->nullable();
            $table->string('status')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('link_git')->nullable();
            $table->string('gambar')->nullable();
            $table->string('uploader')->nullable();
            $table->dateTime('tgl_update')->nullable();
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
        Schema::dropIfExists('fiturs');
    }
};
