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
        Schema::create('room_members', function (Blueprint $table) {
            $table->unsignedBigInteger('room_id');
            $table->unsignedBigInteger('member_id');
            $table->softDeletes();
            // 外部キー成約
            $table->foreign('room_id')->references('id')->on('rooms');
            $table->foreign('member_id')->references('id')->on('users');

            //ユニーク成約
            $table->unique(['member_id','deleted_at'],'room_members_member_id_unique');

            //インデックス
            $table->index('room_id');
            $table->index('member_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('room_members');
    }
};
