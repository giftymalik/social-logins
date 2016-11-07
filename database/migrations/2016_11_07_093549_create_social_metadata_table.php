<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocialMetadataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_metadata', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->string('channel');
            $table->string('channel_user_id');
            $table->timestamps();

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('social_metadata', function(Blueprint $table){
            $table->dropForeign(['user_id']);
        });

        Schema::drop('social_metadata');
    }
}
