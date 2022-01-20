<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SantriBerita extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('santri_berita', function ($table) {
            $table->uuid('id')->primary();
            // $table->morphs('tokenable');
            $table->foreignUuid('berita_id');
            $table->foreign('berita_id')->references('id')->on('berita')->onDelete('cascade');
            $table->string('s_nis',15);
            $table->foreign('s_nis')->references('s_nis')->on('santri')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('santri_berita');
    }
}
