<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmmUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smm_users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nik');
            $table->string('departemen');
            $table->double('phone');
            $table->string('email');
            $table->enum('gender', ['pria', 'wanita']);
            $table->string('province');
            $table->string('city');
            $table->string('subdistrict');
            $table->string('address');
            $table->timestamp('date')->default(now());
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
        Schema::dropIfExists('smm_users');
    }
}
