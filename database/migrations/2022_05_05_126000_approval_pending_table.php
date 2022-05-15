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
        Schema::create('approval_pending', function (Blueprint $table) {
            $table->unsignedBigInteger('owner_id');
            $table->unsignedBigInteger('room_id');
            $table->unsignedBigInteger('requester_id');

            $table->softDeletes();
            // 外部キー成約
            $table->foreign('owner_id')->references('id')->on('users');
            $table->foreign('requester_id')->references('id')->on('users');
            $table->foreign('room_id')->references('id')->on('rooms');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('approval_pending');
    }
};
