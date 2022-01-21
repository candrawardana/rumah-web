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
            $table->string('s_nis',15);
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
