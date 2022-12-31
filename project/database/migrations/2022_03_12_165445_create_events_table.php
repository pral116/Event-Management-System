<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('category', ['Concert', 'Aud', 'Hotel']);
            $table->foreignid('address_id')->constrained();
            $table->string('latitude');
            $table->string('longitude');
            $table->string('date');
            $table->enum('cost_type', ['Free', 'Paid']);
            $table->integer('ticket_quantity')->default(0);
            $table->integer('rate')->nullable();
            $table->longText('description');
            $table->string('image');
            $table->foreignid('user_id')->constrained();
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
        Schema::dropIfExists('events');
    }
}
