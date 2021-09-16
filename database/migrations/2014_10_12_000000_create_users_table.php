<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->string('id', 32)->primary();
            $table->string('label_id',20)->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('jenis',20)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('ktp',50)->nullable();
            $table->string('rekening',50)->nullable();
            $table->string('pekerjaan',50)->nullable();
            $table->string('hp',20)->nullable();

            $table->string('alamat',100)->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
