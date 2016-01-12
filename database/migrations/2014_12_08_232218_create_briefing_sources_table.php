<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBriefingSourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('briefing_sources', function (Blueprint $table) {
        	$table->increments('id');
        	$table->integer('user_id')->unsigned();
        	$table->foreign('user_id')->references('id')->on('users');
        	$table->integer('last_updated_user_id')->unsigned();
        	$table->foreign('last_updated_user_id')->references('id')->on('users');
            $table->string('name');
            $table->integer('briefing_source_type_id')->unsigned();
            $table->foreign('briefing_source_type_id')->references('id')->on('briefing_source_types');
            $table->timestamps();
            
            $table->index('user_id');
            $table->index('last_updated_user_id');
            $table->index('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('briefing_sources');
    }
}
