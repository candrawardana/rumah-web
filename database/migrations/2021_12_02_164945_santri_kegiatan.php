<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SantriKegiatan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('santri_kegiatan', function ($table) {
            $table->uuid('id')->primary();
            // $table->morphs('tokenable');
            $table->foreignUuid('kegiatan_id');
            $table->foreign('kegiatan_id')->references('id')->on('kegiatan')->onDelete('cascade');
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
        Schema::dropIfExists('santri_kegiatan');
    }

}
