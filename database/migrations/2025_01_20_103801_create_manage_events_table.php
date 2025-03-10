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
        Schema::create('manage_events', function (Blueprint $table) {
            $table->id();
            $table->string('event_code')->uniqid();
            $table->string('event_title');
            $table->string('event_date');
            $table->integer('state_id');
            $table->integer('district_id');
            $table->integer('city_id');
            $table->string('pincode');
            $table->string('event_banner');
            $table->string('total_tickets');
            $table->longText('event_desc')->nullable();
            $table->enum('status', ['0', '1', '2'])->default('0')->comment('0: Unpublished, 1: Published, 2: Completed');

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
        Schema::dropIfExists('manage_events');
    }
};
