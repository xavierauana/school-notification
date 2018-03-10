<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommunicationChannelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('communication_channels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('communication_type');
            $table->unsignedInteger('communication_id');
            $table->unsignedInteger('contact_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('communication_channels');
    }
}
