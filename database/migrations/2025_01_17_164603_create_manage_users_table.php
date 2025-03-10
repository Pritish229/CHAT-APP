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
        Schema::create('manage_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('user_role')->default(1); // 0 = admin, 1 = user
            $table->string('f_name');
            $table->string('email')->unique();
            $table->string('phone_no')->nullable();
            $table->string('image')->nullable();
            $table->string('password')->nullable();
            $table->string('c_password')->nullable();

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
        Schema::dropIfExists('manage_users');
    }
};
