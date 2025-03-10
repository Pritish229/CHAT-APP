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
        Schema::create('manage_tickets', function (Blueprint $table) {
            $table->id();
            $table->integer('event_id');
            $table->string('ticket_type');
            $table->string('ticket_no');
            $table->string('ticket_price');
            $table->enum('status', ['0', '1'])->default('0')->comment('0: Avilable, 1: Booked,');
            $table->integer('purchease_by')->nullable();
            $table->string('purchase_date')->nullable();
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
        Schema::dropIfExists('manage_tickets');
    }
};
