<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
        	$table->increments('id');
        	$table->integer('user_id')->unsigned();
        	$table->foreign('user_id')->references('id')->on('users');
        	$table->integer('last_updated_user_id')->unsigned();
        	$table->foreign('last_updated_user_id')->references('id')->on('users');
            $table->string('name');
            $table->integer('customer_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->timestamps();
            
            $table->index('user_id');
            $table->index('last_updated_user_id');
            $table->index('name');
            $table->index('customer_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('contacts');
    }
}
