<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBriefingsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('briefings', function (Blueprint $table) {
        	$table->increments('id');
        	$table->integer('user_id')->unsigned();
        	$table->foreign('user_id')->references('id')->on('users');
        	$table->integer('last_updated_user_id')->unsigned();
        	$table->foreign('last_updated_user_id')->references('id')->on('users');
            $table->date('date_briefing');
            $table->integer('customer_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->integer('customer_type_id')->unsigned();
            $table->foreign('customer_type_id')->references('id')->on('customer_types');
            $table->integer('contact_id')->unsigned();
            $table->foreign('contact_id')->references('id')->on('contacts');
            $table->integer('prod_id')->unsigned();
            $table->foreign('prod_id')->references('id')->on('products');
            $table->integer('iol_prod_id')->unsigned();
            $table->foreign('iol_prod_id')->references('id')->on('products');
            $table->integer('briefing_owner_id')->unsigned();
            $table->foreign('briefing_owner_id')->references('id')->on('briefing_owners');
            $table->integer('briefing_source_id')->unsigned();
            $table->foreign('briefing_source_id')->references('id')->on('briefing_sources');
            $table->boolean('challenge');
            $table->boolean('closed');
            $table->timestamps();
            
            $table->index('user_id');
            $table->index('last_updated_user_id');
            $table->index('date_briefing');
            $table->index('customer_id');
            $table->index('contact_id');
            $table->index('prod_id');
            $table->index('iol_prod_id');
            $table->index('customer_type_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('briefings');
    }

}
